import React from 'react';
import AddProduct from './components/AddProduct';
import ProductList from './components/ProductList';

const App = () => {
    return (
        <div>
            <ProductList />
            <AddProduct/>
        </div>
    );
};

export default App;