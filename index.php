<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/style.css" />

  <title>Praktika</title>
</head>

<body>
  <div id="search-box">
    <input type="text" name="searchBar" id="searchBar" placeholder="Searchbar" />
  </div>

  <div class="results">

    <h3> --- ( %--% result(s))</h3>
  </div>
  <table class="table">
    <tr>
      <th>
        Site
      </th>
      <th>
        Alexa Rank
      </th>
      <th>
        Visitors
      </th>
    </tr>

    <?php require('action.php') ?>
  </table>
</body>
<script type="text/javascript" src="script.js"></script>

</html>