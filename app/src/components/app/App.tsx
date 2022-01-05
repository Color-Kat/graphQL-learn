import React from "react";
import { NavBar } from "../navBar/NavBar";
import { Main } from "../main/Main";

import "./App.css";

const App: React.FC = () => {
  return (
    <div className="App bg-orange-100 w-screen h-screen">
      <NavBar />

      <Main />
    </div>
  );
};

export default App;
