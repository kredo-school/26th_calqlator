<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meal Registration Dinner</title>
  <link href="https://cdnjs.cloudflare.com/ajax/ajax/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/css/meal.style.css') }}">
</head>
<body>
  <div class="container mt-5">
    <div class="underline-container">
      <h2 class="underline text-left">Meal Registration Dinner</h2>
    </div>
    <table class="table table-bordered" id="mealTable">
      <thead>
        <tr>
          <th>Item</th>
          <th>Calories</th>
          <th>Amount</th>
          <th>Time eaten</th>
          <th>Protein</th>
          <th>Carbohydrate</th>
          <th>Lipid</th>
          <th>Save</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($meals as $meal)
          <tr>
            <form action="{{ route('meals.update', ['id' => $meal->id]) }}" method="POST">
              @csrf
              @method('PUT')
              <td>{{ $meal->item }}</td>
              <td>{{ $meal->calories }} kcal</td>
              <td><input type="text" name="amount" value="{{ $meal->amount }}" class="form-control"></td>
              <td><input type="time" name="time_eaten" value="{{ $meal->time_eaten }}" class="form-control"></td>
              <td><input type="number" name="protein" value="{{ $meal->protein }}" class="form-control"></td>
              <td><input type="number" name="carbohydrate" value="{{ $meal->carbohydrate }}" class="form-control"></td>
              <td><input type="number" name="lipid" value="{{ $meal->lipid }}" class="form-control"></td>
              <td><button type="submit" class="btn btn-outline-primary">Save</button></td>
            </form>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center">No food registered</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="text-center p-2">
      <button class="btn btn-outline-danger rounded-circle btn-sm" data-toggle="modal" data-target="#addFoodModal" title="Add">
        <i class="fa-solid fa-plus"></i>
      </button> Add Food
    </div>
    <form action="/search" method="GET" class="d-flex justify-content-center">
      <div class="form-group">
        <input type="text" class="form-control w-80" name="query" placeholder="Search...">
      </div>
    </form>
    <h2 class="history text-center">History</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Item</th>
          <th>Calories</th>
          <th>Per amount</th>
          <th>Protein</th>
          <th>Carbohydrate</th>
          <th>Lipid</th>
          <th></th>
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
            <td><button class="btn btn-outline-danger rounded-circle btn-sm add-to-meal" data-id="{{ $meal->id }}" data-item="{{ $meal->item }}" data-calories="{{ $meal->calories }}" data-amount="{{ $meal->amount }}" title="Add">
              <i class="fa-solid fa-plus"></i>
            </button> Add</td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center">No food registered</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="addFoodModal" tabindex="-1" aria-labelledby="addFoodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content text-center">
        <div class="modal-header">
          <h5 class="modal-title" id="addFoodModalLabel">Register my own meal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addFoodForm" action="{{ route('meals.store') }}" method="POST">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="item">Food Name</label>
                <input type="text" class="mborder form-control" id="item" name="item" placeholder="Banana" required>
              </div>
              <div class="form-group col-md-6">
                <label for="calories">Calories per amount</label>
                <input type="number" class="mborder form-control" id="calories" name="calories" placeholder="50 kcal" required>
              </div>
              <div class="form-group col-md-6">
                <label for="amount_value">Amount</label>
                <div class="input-group">
                  <input type="number" class="mborder form-control" id="amount_value" name="amount_value" placeholder="50" required>
                  <div class="input-group-append">
                    <select class="mborder form-control" id="amount_unit" name="amount_unit" required>
                      <option value="g">g</option>
                      <option value="ml">ml</option>
                      <option value="quantity">quantity</option>
                      <option value="one meal">one meal</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="calories">Time eaten</label>
                <input type="time" class="mborder form-control" id="time_eaten" name="time_eaten" placeholder="19:30" required>
              </div>
              <div class="form-group col-md-6">
                <label for="calories">Protein</label>
                <input type="number" class="mborder form-control" id="protein" name="protein" placeholder="50 kcal" required>
              </div>
              <div class="form-group col-md-6">
                <label for="calories">Cabohydrate</label>
                <input type="number" class="mborder form-control" id="carbohydrate" name="carbohydrate" placeholder="50 kcal" required>
              </div>
              <div class="form-group col-md-6">
                <label for="calories">Lipid</label>
                <input type="number" class="mborder form-control" id="lipid" name="lipid" placeholder="50 kcal" required>
              </div>
            </div>
            <button type="submit" class="btn btn-outline-primary">ADD</button>
          </form>
          <div class="form-group mt-3">
            <button type="button" class="btn btn-outline-secondary" id="sendRequestButton">
              <i class="fas fa-check" id="checkIcon" style="display: none;"></i>
            </button> Send request to add to database
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    document.getElementById('sendRequestButton').addEventListener('click', function() {
      var checkIcon = document.getElementById('checkIcon');
      if (checkIcon.style.display === 'none') {
        checkIcon.style.display = 'inline';
      } else {
        checkIcon.style.display = 'none';
      }
    });

    document.querySelectorAll('.add-to-meal').forEach(button => {
      button.addEventListener('click', function() {
        const item = this.getAttribute('data-item');
        const calories = this.getAttribute('data-calories');
        const amount = this.getAttribute('data-amount');

        // 上の表に追加
        const newRow = `
          <tr>
            <td>${item}</td>
            <td>${calories} kcal</td>
            <td><input type="text" name="amount" value="${amount}" class="form-control"></td>
            <td><input type="text" name="time_eaten" value="" class="form-control"></td>
            <td><input type="number" name="protein" value="" class="form-control"></td>
            <td><input type="number" name="carbohydrate" value="" class="form-control"></td>
            <td><input type="number" name="lipid" value="" class="form-control"></td>
            <td><button type="submit" class="btn btn-outline-primary">Save</button></td>
          </tr>
        `;

        document.querySelector('#mealTable tbody').insertAdjacentHTML('beforeend', newRow);
      });
    });
  </script>
</body>
</html>
