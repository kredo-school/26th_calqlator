<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meal Confirmation Lunch</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="underline-container">
      <h2 class="underline text-left">Meal Confirmation Lunch</h2>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Item</th>
          <th>Calories</th>
          <th>Amount</th>
          <th>Time eaten</th>
          <th>Protein</th>
          <th>Carbohydrate</th>
          <th>Lipid</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($meals as $meal)
          <tr>
            <td>{{ $meal->item }}</td>
            <td>{{ $meal->calories }} kcal</td>
            <td>{{ $meal->amount }}</td>
            <td>{{ $meal->time_eaten }}</td>
            <td>{{ $meal->protein }} kcal</td>
            <td>{{ $meal->carbohydrate }} kcal</td>
            <td>{{ $meal->lipid }} kcal</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6" class="text-right">Total Calories:</td>
          <td id="totalCalories">0 kcal</td>
        </tr>
      </tfoot>
    </table>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const totalCalories = urlParams.get('totalCalories');
      if (totalCalories) {
        document.getElementById('totalCalories').textContent = `${totalCalories} kcal`;
      }
    });
  </script>
</body>
</html>