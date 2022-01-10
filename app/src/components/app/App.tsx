import React, { useEffect, useState } from "react";
import { NavBar } from "../navBar/NavBar";
import { Main } from "../main/Main";

import "./App.css";
import { IUser, UserContext } from "../../context/userContext";
import { useQuery } from "@apollo/client";
import { IS_AUTH } from "../../graphql/queries";

const links = [
  {
    title: "My cats",
    path: "/my_cats",
  },
  {
    title: "Cats shop",
    path: "/shop",
  },
];

const App: React.FC = () => {
  const setUser = (user: IUser) => {
    setUserState((prev) => ({ ...prev, value: user }));
  };

  const [user, setUserState] = useState({
    value: { isAuth: false },
    bind: setUser,
  });

  const { data, error } = useQuery(IS_AUTH);

  useEffect(() => {
    console.log(data);
    if (!data?.isAuth) return;
  }, [data, error]);

  return (
    <div className="App bg-orange-100 w-screen h-screen">
      <UserContext.Provider value={user}>
        <NavBar links={links} />
        <Main />
      </UserContext.Provider>
    </div>
  );
};

export default App;
