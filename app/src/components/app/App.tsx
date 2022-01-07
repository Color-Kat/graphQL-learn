import React from "react";
import { NavBar } from "../navBar/NavBar";
import { Main } from "../main/Main";

import "./App.css";

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
  return (
    <div className="App bg-orange-100 w-screen h-screen">
      <NavBar links={links} />

      <Main />
    </div>
  );
};

export default App;
