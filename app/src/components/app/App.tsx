import React from "react";
import { NavBar } from "../navBar/NavBar";

import "./App.css";

const App: React.FC = () => {
  return (
    <div className="App bg-orange-100 w-screen h-screen">
      <NavBar />
    </div>
  );
};

export default App;
