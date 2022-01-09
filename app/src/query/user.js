import { gql } from '@apollo/client';

export const GET_ALL_USERS = gql`
    query get_all_users{
        users{
            id, name, email, money, cats{id, name, dna, birthday}
        }
    }
`;

export const GET_USER_BY_ID = gql`
    query get_user_by_id($id: ID!) {
        user(id: $id){
            id, name, email, money, cats{id, name, dna, birthday}
        }
    }
`;