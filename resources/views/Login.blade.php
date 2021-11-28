<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=password], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}
button {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  margin-right: 30%;
  margin-left: 40%;
}
</style>

<x-header />
<br/><br/><br/>
<h1 style="text-align:center;">Login Form</h1>

<div class="container">
  <form action="user" method="POST">
    @csrf
    <label for="fname">First Name</label>
    <input type="text" id="user" name="user" placeholder="Your name.." required>

    <label for="lname">Password</label>
    <input type="password" id="password" name="password" placeholder="Your Password.." required>

    <button type="submit">Submit</button>
  </form>
</div>