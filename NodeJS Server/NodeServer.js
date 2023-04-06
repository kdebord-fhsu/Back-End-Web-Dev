const express = require("express");
const app = express();
const path = require("path");
const fs = require("fs");
const { logEvents } = require("./logEvents");
const PORT = process.env.PORT || 3000;

// Middleware to log server events
app.use((req, res, next) => {
  logEvents(`${req.method} ${req.headers.origin} ${req.url}`);
  console.log(`${req.method} ${req.path}`);
  next();
});

// Set up CORS configuration
const whiteList = [
  "https://www.google.com",
  "http://127.0.0.1:5500",
  "http://localhost3000",
];
const corsOptions = {
  origin: (origin, callback) => {
    if (whiteList.indexOf(origin) !== -1 || !origin) {
      callback(null, true);
    } else {
      callback(new Error("Not allowed by CORS"));
    }
  },
};
app.use(cors());

// Middleware to handle request bodies in different formats and serve static files
app.use(express.urlencoded({ extended: false }));
app.use(express.json());
app.use(express.static(path.join(__dirname, "public")));

// Route handlers for serving HTML pages
app.get("^/$|/index(.html)?", (req, res) => {
  res.sendFile(path.join(__dirname, "views", "index.html"));
});

app.get("/new-page.html", (req, res) => {
  res.sendFile(path.join(__dirname, "views", "new-page.html"));
});

app.get("/old-page.html", (req, res) => {
  res.redirect(301, "new-page.html");
});

// Route handlers for serving images
app.get("/images/:tiger.jpg", (req, res) => {
  const filePath = path.join(__dirname, "public", "images", req.params.filename);
  if (fs.existsSync(filePath)) {
    res.sendFile(filePath);
  } else {
    res.status(404).send("File not found");
  }
});

// Route handlers for other requests
app.get("/hello(.html)?", (req, res) => {
  console.log("Attempted to serve hello.html");
  res.send("hello world");
});

// Chain multiple middleware functions to handle a request
const one = function (req, res, next) {
  console.log("One");
  next();
};
const two = function (req, res, next) {
  console.log("Two");
  next();
};
const three = function (req, res, next) {
  console.log("Three");
  res.send("Hello from Three!");
};
app.get("/chain(.html)?", [One, Two, Three]);

app.all("*", (req, res)=>{
    res.status(404);
    if (req.accepts("html")){
       res.sendFile(path.join(__dirname, "views", "404.html")); 
    } else if (req.accepts("json")) {
        res.json({ error: "404 not found"});
    } else {
        res.type("txt").send("404 not found");
    }
    
});

app.use(errorHandler);
app.listen(PORT, ()=>console.log(`Server is listing on port ${PORT}`));