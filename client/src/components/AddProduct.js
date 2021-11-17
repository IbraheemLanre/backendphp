import React, { useState } from "react";
import FormHelperText from "@mui/material/FormHelperText";
import { postBook, postDvd, postFurniture, postProduct } from "./apis";

const AddProduct = () => {
  const [newProduct, setNewProduct] = useState({
    sku: "",
    name: "",
    price: null,
  });
  const [newFurniture, setNewFurniture] = useState({
    height: null,
    width: null,
    length: null,
  });

  const [newBook, setNewBook] = useState({ weight: "" });
  const [newDvd, setNewDvd] = useState({ size: "" });

  const insertProduct = async (e) => {
    e.preventDefault();
     await fetch(postProduct, {
      method: "POST",
      mode: "no-cors",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        newProduct,
      }),
    })
      .then((res) => res.json()).then(data=>console.log(data))
      .catch((err) => console.log(err));
  };

  const insertFurniture = async (e) => {
    e.preventDefault();
    await fetch(postFurniture, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        newFurniture,
      }),
    })
      .then((res) => res.json())
      .catch((err) => console.log(err));
  };

  const insertBook = async (e) => {
    e.preventDefault();
    await fetch(postBook, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        newBook,
      }),
    })
      .then((res) => res.json())
      .catch((err) => console.log(err));
  };

  const insertDvd = async (e) => {
    e.preventDefault();
    fetch(postDvd, {
      method: "POST",
      headers: "Content-Type: application/json",
      body: {
        newDvd,
      },
    })
      .then((res) => {
        const data = res.json();
        console.log(data);
      })
      .catch((err) => console.log(err));
  };

  const typeSwitcher = () => {
    const submit = false;
    if (!submit) {
      insertFurniture();
    } else if (!submit) {
      insertBook();
    } else {
      insertDvd();
    }
  };

  const handleProductChange = (e) => {
    setNewProduct({
      ...newProduct,
      [e.target.name]: e.target.value,
    });
  };

  const handleFurnitureChange = (e) => {
    setNewFurniture({
      ...newFurniture,
      [e.target.value]: e.target.value,
    });
  };

  const handleBookChange = (e) => {
    setNewBook({
      ...newBook,
      [e.target.value]: e.target.value,
    });
  };

  const handleDvdChange = (e) => {
    setNewDvd({
      ...newDvd,
      [e.target.value]: e.target.value,
    });
  };

  return (
    <>
      <div className="formContainer" id="product_form">
        <form onSubmit={insertProduct}>
          <div className="formGroup">
            <label htmlFor="sku">SKU</label>
            <input
              type="text"
              name="sku"
              id="sku"
              placeholder="sku"
              maxLength="20"
              onChange={handleProductChange}
            />
          </div>
          <div className="formGroup">
            <label htmlFor="name">Name</label>
            <input
              type="text"
              name="name"
              id="name"
              placeholder="name"
              maxLength="50"
              onChange={handleProductChange}
            />
          </div>

          <div className="formGroup">
            <label htmlFor="price">Price</label>
            <input
              type="text"
              name="price"
              id="price"
              placeholder="price"
              maxLength="6"
              onChange={handleProductChange}
            />
          </div>
          <button type="submit">Submit</button>
        </form>
      </div>

      <div>
        {/* Specific product form */}
        <form onSubmit={typeSwitcher}>
          <div className="formGroup product-specific">
            <label htmlFor="size">Size (MB)</label>
            <input
              type="text"
              name="size"
              id="size"
              placeholder="size"
              maxLength="6"
              onChange={handleDvdChange}
            />
            <FormHelperText id="my-helper-text">
              Please provide size in Megabyte.
            </FormHelperText>
          </div>

          <div className="formGroup product-specific">
            <label htmlFor="weight">Weight (KG)</label>
            <input
              type="text"
              name="weight"
              id="weight"
              placeholder="weight"
              maxLength="4"
              onChange={handleBookChange}
            />
            <FormHelperText id="my-helper-text">
              Please provide weight in Kilogram.
            </FormHelperText>
          </div>

          <div className="formGroup product-specific">
            <label htmlFor="height">Height (CM)</label>
            <input
              type="text"
              name="height"
              id="height"
              placeholder="height"
              maxLength="4"
              onChange={handleFurnitureChange}
            />
            <FormHelperText id="my-helper-text">
              Please provide dimensions in HxWxL.
            </FormHelperText>
          </div>

          <div className="formGroup product-specific">
            <label htmlFor="width">Width (CM)</label>
            <input
              type="text"
              name="width"
              id="width"
              placeholder="width"
              maxLength="4"
              onChange={handleFurnitureChange}
            />
            <FormHelperText id="my-helper-text">
              Please provide dimensions in HxWxL.
            </FormHelperText>
          </div>

          <div className="formGroup product-specific">
            <label htmlFor="length">Length (CM)</label>
            <input
              type="text"
              name="length"
              id="length"
              placeholder="length"
              maxLength="4"
              onChange={handleFurnitureChange}
            />
            <FormHelperText id="my-helper-text">
              Please provide dimensions in HxWxL.
            </FormHelperText>
          </div>
          <button type="submit">Submit</button>
        </form>
      </div>
    </>
  );
};

export default AddProduct;
