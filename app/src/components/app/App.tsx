import React, {useState} from 'react';
import { Listbox } from '@headlessui/react'

import './App.css';

function App() {

  const cats = [
    {id: 1, name: 'Simba'},
    {id: 2, name: 'Boris'},
    {id: 3, name: 'Timofey'},
    {id: 4, name: 'Leopold'},
    {id: 5, name: 'Murka'},
  ];

  const [selected, setSelected] = useState(cats[0]);

  return (
    <div className="App">
      <Listbox value={selected} onChange={setSelected}>
          <Listbox.Button><span className="p-4 bg-orange-400 flex items-center m-4 rounded-xl">{selected.name}</span></Listbox.Button>
          <div className="flex justify-center">
              <Listbox.Options>
                  <div className="options block w-32">
                      {
                          cats.map(cat => (
                              <Listbox.Option
                                  key={cat.id}
                                  value={cat}
                              >
                                  <li className="bg-blue-500 text-white my-4 rounded-2xl h-12 flex items-center justify-center">{cat.name}</li>
                              </Listbox.Option>
                          ))
                      }
                  </div>
              </Listbox.Options>
          </div>
      </Listbox>
    </div>
  );
}

export default App;
