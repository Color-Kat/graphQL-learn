import React, { useState } from "react";

interface ILoginUser {
  name: string;
  password: string;
}

export const Login: React.FC = () => {
  const [loginData, setLoginData] = useState<ILoginUser>({
    name: "",
    password: "",
  });

  const error: string = "";

  function nameHandler(event: React.ChangeEvent<HTMLInputElement>): void {
    setLoginData((prev) => ({ ...prev, name: event.target.value }));
  }

  function passwordHandler(event: React.ChangeEvent<HTMLInputElement>): void {
    setLoginData((prev) => ({ ...prev, password: event.target.value }));
  }

  const loginHandler = (e: React.FormEvent) => {
    e.preventDefault();
  };

  return (
    <div id="login-form">
      <h1 className="text-5xl text-gray-700 py-4 border-b-2 border-gray-600">
        Welcome to <b>MoneyKitties</b>!
      </h1>

      <h3 className="text-3xl my-4 text-gray-700">Login</h3>

      <form
        onSubmit={loginHandler}
        className="rounded px-8 pt-6 pb-8 mb-4 mx-auto md:max-w-lg"
      >
        <div className="mb-4">
          <label
            className="block text-gray-700 text-sm font-bold mb-2"
            htmlFor="username"
          >
            Username
          </label>
          <input
            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="username"
            type="text"
            onChange={nameHandler}
            value={loginData.name}
            placeholder="Username"
          />
        </div>
        <div className="mb-6">
          <label
            className="block text-gray-700 text-sm font-bold mb-2"
            htmlFor="password"
          >
            Password
          </label>
          <input
            className="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="password"
            type="password"
            onChange={passwordHandler}
            value={loginData.password}
            placeholder="***************"
          />
          <p className="text-red-500 text-xs italic">{error}</p>
        </div>
        <div className="flex items-center justify-between">
          <button
            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit"
          >
            Sign In
          </button>
          <a
            className="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
            href="#"
          >
            Forgot Password?
          </a>
        </div>
      </form>
      <p className="text-center text-gray-500 text-xs">
        &copy;2020 Acme Corp. All rights reserved.
      </p>
    </div>
  );
};
