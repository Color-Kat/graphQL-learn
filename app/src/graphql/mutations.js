import { gql } from '@apollo/client';

export const LOGIN = gql`
    query get_all_users{
        users{
            id, name, email, money, cats{id, name, dna, birthday}
        }
    }
`;