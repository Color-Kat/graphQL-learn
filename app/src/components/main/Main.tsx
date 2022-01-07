import React from "react";
import { Routes, Route } from "react-router-dom";
import { Home } from "../home/Home";
import { Login } from "../login/Login";

export const Main: React.FC = () => {
  return (
    <main className="container mx-auto p-3 mt-16 bg-orange-200 shadow-lg rounded-lg">
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="*" element={<h1>404 - PageNotFound, MEOW</h1>} />
      </Routes>
    </main>
  );
};
