<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Meal</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/css/meal.style.css') }}">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Edit Meal</h2>
    <form action="{{ route('meals.update', $meal->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="item">Food Name</label>
          <input type="text" class="mborder form-control" id="item" name="item" value="{{ $meal->item }}" required>
        </div>
        <div class="form-group col-md-6">
          <label for="calories">Calories per amount</label>
          <input type="number" class="mborder form-control" id="calories" name="calories" value="{{ $meal->calories }}" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="amount">Amount</label>
          <input type="text" class="mborder form-control" id="amount" name="amount" value="{{ $meal->amount }}" required>
        </div>
        <div class="form-group col-md-6">
          <label for="protein">Protein</label>
          <input type="number" class="mborder form-control" id="protein" name="protein" value="{{ $meal->protein }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="carbohydrate">Carbohydrate</label>
          <input type="number" class="mborder form-control" id="carbohydrate" name="carbohydrate" value="{{ $meal->carbohydrate }}">
        </div>
        <div class="form-group col-md-6">
          <label for="lipid">Lipid</label>
          <input type="number" class="mborder form-control" id="lipid" name="lipid" value="{{ $meal->lipid }}">
        </div>
      </div>
      <button type="submit" class="btn btn-outline-primary">Update</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
