import React, {useEffect, useState} from 'react';

import './App.css';

// useState
// function App() {
//     const [count, setCount] = useState(0);
//     const [activity, setActivity] = useState({
//         activity: 'food',
//         currency: 'RUB'
//     });

//     function increment() {
//         setCount(prev => prev+1);
//     }
//     function decrement() { setCount(prev => prev - 1); }
    
//     function changeActivity(e: any) {
//         setActivity(prev => ({...prev, activity: e.target.value}));
//     }

//     return (
//         <div className="App">
//             <div>
//                 <h1>Accounting:</h1>
//                 <input onChange={changeActivity} />
//                 <h1 className="color">{activity.activity}: <b>{count}{ activity.currency }</b></h1>

//                 <button onClick={increment}>Increase</button>
//                 <button onClick={decrement}>Decrease</button>
//             </div>
//         </div>
//     );
// }

// useEffect
function App() {
    const [page, setPage] = useState('posts');
    const [content, setContent] = useState('Loading');
    
    useEffect(() => {
        setContent('Loading');
        fetch(`https://jsonplaceholder.typicode.com/${page}/1`)
            .then(response => response.json())
            .then(json => setContent(JSON.stringify(json, null, 2))
            )
                    
    }, [page]);

    return (
        <div className="App">
            <div>
                <h1>{page}</h1>
                <button onClick={()=>setPage('posts')}>Posts</button>
                <button onClick={() => setPage('photos')}>photos</button>
                <button onClick={() => setPage('users')}>users</button>
                <br />
                <span ><pre>{content}</pre></span>
            </div>
        </div>
    );
}

export default App;
