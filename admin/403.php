<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
       * {
  box-sizing: border-box;
}
body {
  margin: 0px;
  padding: 0px;
  font-family: poppins;
  background-image: url("..Images/bg.png");
  background-size: 350px;
  background-position: center;
}

.page-not-found img {
  height: 300px;
  background-color: rgba(255, 255, 255, 0.5);
}

.page-not-found {
  position: absolute;
  left: 50%;
  top: 60%;
  transform: translate(-50%, -60%);
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.page-not-found h1 {
  color: #3b3a39;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 2rem;
  margin: 0px 0px 0px 0px;
}

.page-not-found p {
  color: #808080;
  font-size: 1rem;
  width: 60%;
  text-align: center;
  margin: 5px;
  font-weight: 300;
}

.page-not-found a {
  color: #637eff;
  font: weight 600;
  text-decoration: underline;
}

.page-not-found button {
  width: 140px;
  height: 40px;
  margin: 10px;
  background-color: #2f2e41;
  color: #ffffff;
  text-transform: uppercase;
  outline: none;
  border: none;
  letter-spacing: 1px;
  box-shadow: 2px 2px 30px rgba(0, 0, 0, 0.1);
}

button:hover {
  background-color: #637eff;
  transition: all ease 0.3s;
}

@media (max-width: 900px) {
  .page-not-found img {
    height: 180px;
  }

  .page-not-found p {
    width: 100%;
  }
}

@media (max-width: 600px) {
  .page-not-found {
    width: 100%;
  }
  .page-not-found img {
    height: 120px;
  }
  .page-not-found h1 {
    font-size: 1.4rem;
    text-align: center;
  }
  .page-not-found p {
    width: 90%;
  }
}
    </style>
</head>
  <body>
    <section class="page-not-found">
      <img src="https://image.freepik.com/free-vector/403-error-forbidden-with-police-concept-illustration_114360-1884.jpg" alt="" />

      <h1>Page NOt Found</h1>
      <p>
        You do not have permission to access this page
      </p>

    </section>
  </body>
</html>
