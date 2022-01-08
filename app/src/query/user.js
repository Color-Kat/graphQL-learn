import { gql } from '@apollo/client';

export const GET_ALL_USERS = gql`
    query{
        user(id: 3){
            name, email, money
        }
    }
`;