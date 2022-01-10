import React from "react";

export const Introduction: React.FC = () => {
  return (
    <div id="intro">
      <h1 className="text-5xl text-gray-700 my-4">
        Welcome to <b>MoneyKitties</b>
      </h1>
      <p className="text-xl ">
        This is a project where you buy cats and breed them. And here you can
        <img
          src="/images/welcome_cats.png"
          alt="welcome cats image"
          className="m-auto"
        />
      </p>
    </div>
  );
};
