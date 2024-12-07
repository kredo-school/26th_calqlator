<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meal History</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/css/meal.style.css') }}">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Meal History</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Item</th>
          <th>Calories</th>
          <th>Amount</th>
          <th>Protein</th>
          <th>Carbohydrate</th>
          <th>Lipid</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($meals as $meal)
          <tr>
            <td>{{ $meal->item }}</td>
            <td>{{ $meal->calories }} kcal</td>
            <td>{{ $meal->amount }}</td>
            <td>{{ $meal->protein }} kcal</td>
            <td>{{ $meal->carbohydrate }} kcal</td>
            <td>{{ $meal->lipid }} kcal</td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center">No food registered</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
