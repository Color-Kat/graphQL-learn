import { gql } from '@apollo/client';

export const LOGIN = gql`
    mutation login($email: Email!, $password: String!){
        login(email: $email, password: $password){
            id, name, email, money
        }
    }
`;