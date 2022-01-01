import React, {useState} from 'react';

import './App.css';

function App() {
    const [count, setCount] = useState(0);
    const [activity, setActivity] = useState({
        activity: 'food',
        currency: 'RUB'
    });

    function increment() {
        setCount(prev => prev+1);
    }
    function decrement() { setCount(prev => prev - 1); }
    
    function changeActivity(e: any) {
        setActivity(prev => ({...prev, activity: e.target.value}));
    }

    return (
        <div className="App">
            <div>
                <h1>Accounting:</h1>
                <input onChange={changeActivity} />
                <h1 className="color">{activity.activity}: <b>{count}{ activity.currency }</b></h1>

                <button onClick={increment}>Increase</button>
                <button onClick={decrement}>Decrease</button>
            </div>
        </div>
    );
}

export default App;
