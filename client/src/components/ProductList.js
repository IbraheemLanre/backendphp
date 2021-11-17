// import React, { useEffect, useState } from "react";
import * as React from "react";
import { useEffect, useState } from "react";
import Card from "@mui/material/Card";
import CardContent from "@mui/material/CardContent";
import Typography from "@mui/material/Typography";
import "./ProductStyles.css";
import { getFurniture, getBook, getDvd } from "./apis";

const ProductList = () => {
  const [furniture, setFurniture] = useState([]);
  const [books, setBooks] = useState([]);
  const [dvds, setDvds] = useState([]);

  useEffect(() => {
    fetch(getFurniture)
      .then((res) => res.json())
      .then((data) => setFurniture(data))
      .catch((err) => console.log(err));
  }, [furniture]);

  useEffect(() => {
    fetch(getBook)
      .then((res) => res.json())
      .then((data) => setBooks(data))
      .catch((err) => console.log(err));
  }, [books]);

  useEffect(() => {
    fetch(getDvd)
      .then((res) => res.json())
      .then((data) => setDvds(data))
      .catch((err) => console.log(err));
  }, [dvds]);

  return (
    <>
      Products Will Appear Here!
      <div className="container">
        {furniture.map((furniture) => (
          <Card sx={{ minWidth: 275 }} key={furniture.productId}>
            <CardContent className="product-content">
              <Typography
                sx={{ fontSize: 14 }}
                color="text.secondary"
                gutterBottom
              >
                {furniture.sku}
              </Typography>
              <Typography variant="h5" component="div">
                {furniture.name}
              </Typography>
              <Typography sx={{ mb: 1.5 }} color="text.secondary">
                ${furniture.price}
              </Typography>
              <Typography sx={{ mb: 1.5 }} color="text.secondary">
                {furniture.height}m
              </Typography>
              <Typography sx={{ mb: 1.5 }} color="text.secondary">
                {furniture.width}m
              </Typography>
              <Typography sx={{ mb: 1.5 }} color="text.secondary">
                {furniture.length}m
              </Typography>
            </CardContent>
          </Card>
        ))}

        {books.map((book) => (
          <Card sx={{ minWidth: 275 }} key={book.productId}>
            <CardContent className="product-content">
              <Typography
                sx={{ fontSize: 14 }}
                color="text.secondary"
                gutterBottom
              >
                {book.sku}
              </Typography>
              <Typography variant="h5" component="div">
                {book.name}
              </Typography>
              <Typography sx={{ mb: 1.5 }} color="text.secondary">
                ${book.price}
              </Typography>
              <Typography sx={{ mb: 1.5 }} color="text.secondary">
                {book.weight}kg
              </Typography>
            </CardContent>
          </Card>
        ))}

        {dvds.map((product) => (
          <Card sx={{ minWidth: 275 }} key={product.productId}>
            <CardContent className="product-content">
              <Typography
                sx={{ fontSize: 14 }}
                color="text.secondary"
                gutterBottom
              >
                {product.sku}
              </Typography>
              <Typography variant="h5" component="div">
                {product.name}
              </Typography>
              <Typography sx={{ mb: 1.5 }} color="text.secondary">
                ${product.price}
              </Typography>
              <Typography sx={{ mb: 1.5 }} color="text.secondary">
                {product.size}m
              </Typography>
            </CardContent>
          </Card>
        ))}
      </div>
    </>
  );
};

export default ProductList;
