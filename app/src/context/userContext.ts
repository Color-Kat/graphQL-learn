import React from "react";

export interface IUser {
    isAuth: boolean;
    user?: {
        id: number,
        name: string,
        money: number,
        email: string,
        cats: any
    }
};
  
export const UserContext = React.createContext<{
    value: IUser,
    bind?: (user: IUser) => void;
}>({
    value: { isAuth: false }
});