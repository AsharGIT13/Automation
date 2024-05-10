
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: red;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: red;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
        border: 1px solid red;
      }
      .btn-success {
  color: #fff;
  font-size:15px;
  background-color: #198754;
  border-color: #198754;
  padding:10px;
  border-radius:4px;
  margin-top:30px;
  cursor:pointer;
}
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">!</i>
      </div>
        <h1>Oops!</h1> 
        <p>Something went wrong!<br/> try again</p>
     
       <a href="{{route('homepage')}}"> <button class="btn btn-success">Back to Home</button></a>
    </div>
