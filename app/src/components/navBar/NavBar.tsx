import { linkSync } from "fs";
import React, { useEffect, useState } from "react";
import { Link, useLocation } from "react-router-dom";

interface INavProps {
  links: { title: string; path: string }[];
}

export const NavBar: React.FC<INavProps> = ({ links }) => {
  const [isMenu, toggleMenu] = useState<boolean>(false);

  const menuStyle = isMenu ? "max-h-screen" : "max-h-0 lg:max-h-full";

  const hideMenu = () => toggleMenu(false);

  // hide menu when resize
  useEffect(() => {
    window.addEventListener("resize", hideMenu);

    return () => {
      window.removeEventListener("resize", hideMenu);
    };
  }, []);

  // hide menu when navigation
  let location = useLocation()
  useEffect(hideMenu, [location.pathname]);

  function toggleMenuHandler() {
    toggleMenu((prev) => !prev);
  }

  return (
    <nav className="bg-amber-600">
      <div className="container mx-auto flex items-center justify-between flex-wrap p-5">
        <div className="flex items-center flex-shrink-0 text-amber-100 mr-6">
          <Link
            className="w-56 text-center font-semibold text-3xl tracking-tight hover:tracking-tighter"
            to="/"
          >
            &gt;MoneyKitties&lt;
          </Link>
        </div>
        <div className="block lg:hidden">
          <button
            onClick={toggleMenuHandler}
            className="flex items-center px-3 py-2 border rounded bg-amber-100 border-teal-400 hover:text-white hover:border-white"
          >
            <svg
              className="fill-current h-3 w-3"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        <div
          className={
            "w-full block flex-grow lg:flex lg:items-center lg:w-auto overflow-hidden transition-all " +
            menuStyle
          }
        >
          <div className="text-2xl lg:flex-grow mt-5 lg:mt-0 border-t-2 border-amber-100 lg:border-none">
            {links.map((link) => (
              <Link
                to={link.path}
                key={link.path}
                className="block mt-4 lg:inline-block lg:mt-0 text-amber-100 hover:text-white lg:mr-10 hover:scale-105 lg:p-0 p-2"
              >
                {link.title}
              </Link>
            ))}
          </div>
          <div>
            <Link
              to="/login"
              className="inline-block text-sm px-4 py-2 leading-none border rounded text-amber-100 border-white hover:border-transparent hover:text-amber-600 hover:bg-amber-100 mt-4 lg:mt-0"
            >
              Login
            </Link>
          </div>
        </div>
      </div>
    </nav>
  );
};
