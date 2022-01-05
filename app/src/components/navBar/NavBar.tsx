import React from "react";

export const NavBar: React.FC = () => {
  return (
    <nav className="flex items-center justify-between flex-wrap bg-amber-600 p-4">
      <div className="flex items-center flex-shrink-0 text-amber-100 mr-6">
        <span className="font-semibold text-3xl tracking-tight">
          &gt;MoneyKitties&lt;
        </span>
      </div>
      <div className="block lg:hidden">
        <button className="flex items-center px-3 py-2 border rounded bg-amber-100 border-teal-400 hover:text-white hover:border-white">
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
      <div className="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div className="text-xl lg:flex-grow">
          <a
            href="#responsive-header"
            className="block mt-4 lg:inline-block lg:mt-0 text-amber-100 hover:text-white mr-4"
          >
            Docs
          </a>
        </div>
        <div>
          <a
            href="#"
            className="inline-block text-sm px-4 py-2 leading-none border rounded text-amber-100 border-white hover:border-transparent hover:text-amber-600 hover:bg-amber-100 mt-4 lg:mt-0"
          >
            Login
          </a>
        </div>
      </div>
    </nav>
  );
};
