import React, {useEffect, useState, useRef, useMemo} from 'react';

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
// function App() {
//     const [page, setPage] = useState('posts');
//     const [content, setContent] = useState('Loading');
    
//     useEffect(() => {
//         setContent('Loading');
//         fetch(`https://jsonplaceholder.typicode.com/${page}/1`)
//             .then(response => response.json())
//             .then(json => setContent(JSON.stringify(json, null, 2))
//             );
                    
//     }, [page]);

//     useEffect(() => {
//         console.log('componentDidMount');

//         return () => {
//             console.log('componentWillUnmount');
//         }
//     }, []);

//     return (
//         <div className="App">
//             <div>
//                 <h1>{page}</h1>
//                 <button onClick={()=>setPage('posts')}>Posts</button>
//                 <button onClick={() => setPage('photos')}>photos</button>
//                 <button onClick={() => setPage('users')}>users</button>
//                 <br />
//                 <span ><pre>{content}</pre></span>
//             </div>
//         </div>
//     );
// }

// useRef
// function App() {
//     const inputRef = useRef(null);

//     // ref doesn't call rerender components
    
//     function focus() {
//         if (!inputRef.current) return;
//         (inputRef.current as any).focus();
//     }

//     return (
//         <div className="App">
//             <div>
//                 <input type="text" ref={inputRef} />
//                 <button onClick={focus}>Focus</button>
//             </div>
//         </div>
//     );
// }


function hardMathematic(num: number) {
    let i = 0;

    while (i < 1000000000) i++;

    return num + 1;
}

// useMemo
function App() {
    const [number, setNumber] = useState(0);
    const [color, setColor] = useState(true);

    let style = useMemo(() => ({
        color: color ? 'green' : 'red'
    }), [color]);

    useEffect(() => console.log('updated'), [style]);

    // useMemo save the first value and update it only if this value is changed
    const num = useMemo(()=>(hardMathematic(number)), [number]);

    return (
        <div className="App">
            <div>
                <span style={style}>{num}</span>
                <button onClick={() => setNumber(prev => prev + 1)}>increase</button>
                <button onClick={()=>setColor(prev => !prev)}>change color</button>

            </div>
        </div>
    );
}


export default App;
