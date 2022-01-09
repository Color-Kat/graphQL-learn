import { useMutation, useQuery } from "@apollo/client";
import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { LOGIN } from "../../graphql/mutations";
import { GET_ALL_USERS, GET_USER_BY_ID } from "../../graphql/queries";

interface ILoginUser {
  email: string;
  password: string;
}

export const Login: React.FC = () => {
  const [loginData, setLoginData] = useState<ILoginUser>({
    email: "",
    password: "",
  });

  const [errorStr, setErrorStr] = useState<string>("");

  function emailHandler(event: React.ChangeEvent<HTMLInputElement>): void {
    setLoginData((prev) => ({ ...prev, email: event.target.value }));
  }

  function passwordHandler(event: React.ChangeEvent<HTMLInputElement>): void {
    setLoginData((prev) => ({ ...prev, password: event.target.value }));
  }

  const [doLogin] = useMutation(LOGIN);

  const loginHandler = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      let res = await doLogin({
        variables: {
          email: loginData.email,
          password: loginData.password,
        }
      });

      console.log('you are logged in!');
      
    } catch (error: any) {
      console.log(error);
      setErrorStr(error.toString());
    }

    // console.log(res.toString());
  };

  // ----------------
  // const { data, loading, error } = useQuery(GET_USER_BY_ID, {
  //   variables: { id: 6 },
  // });

  // useEffect(() => {
  //   console.log(data);
  //   console.log(error);
  // }, [data, error]);

  // ----------------

  return (
    <div id="login-form">
      <h3 className="text-md text-gray-700">Welcome back!</h3>

      <h1 className="text-3xl mb-2 pb-2 text-gray-700 font-bold border-b border-gray-600">
        Login
      </h1>

      <form
        onSubmit={loginHandler}
        className="rounded px-8 pt-6 pb-8 mb-4 mx-auto md:max-w-lg"
      >
        <div className="mb-4">
          <label
            className="block text-gray-700 text-sm font-bold mb-2"
            htmlFor="username"
          >
            Email
          </label>
          <input
            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="email"
            type="email"
            onChange={emailHandler}
            value={loginData.email}
            placeholder="email"
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
          <p className="text-red-500 text-xs italic">{errorStr}</p>
        </div>
        <div className="flex items-center justify-between">
          <button
            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit"
          >
            Sign In
          </button>
          <Link
            className="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
            to="/register"
          >
            Want to register?
          </Link>
        </div>
      </form>
      <p className="text-center text-gray-500 text-xs">
        &copy;2022 Color Corp. All rights reserved.
      </p>
    </div>
  );
};
