<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/meal.style.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2 class="underline text-center">Meal Registration</h2>
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
                @forelse ($meals as $meal)
                    <tr>
                        <td>{{ $meal->item }}</td>
                        <td>{{ $meal->calories }} kcal</td>
                        <td>{{ $meal->amount }}</td>
                        <td>{{ $meal->time_eaten }}</td>
                        <td>{{ $meal->Protein }} kcal</td>
                        <td>{{ $meal->Carbohydrate }} kcal</td>
                        <td>{{ $meal->Lipid }} kcal</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No food registered</td>
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
        
        <h2 class="text-center">History</h2>
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
                <!-- Example search results -->
                <tr>
                    <td>Meat Sauce Pasta</td>
                    <td>626 kcal</td>
                    <td>per serving (dry pasta 100g)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-outline-danger rounded-circle btn-sm" data-toggle="modal" data-target="#addFoodModal" title="Add">
                        <i class="fa-solid fa-plus"></i>
                    </button> Add</td>
                </tr>
                <tr>
                    <td>Carbonara</td>
                    <td>589 kcal</td>
                    <td>per serving</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-outline-danger rounded-circle btn-sm" data-toggle="modal" data-target="#addFoodModal" title="Add"><i class="fas fa-plus"></i>
                    </button> Add</td>
                </tr>
                <!-- Add more search results as necessary -->
            </tbody>
        </table>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="addFoodModal" tabindex="-1" aria-labelledby="addFoodModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content  text-center">
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
              <input type="text" class="form-control" id="item" name="item" placeholder="Banana" required>
            </div>
            <div class="form-group col-md-6">
              <label for="calories">Calories per amount</label>
              <input type="number" class="form-control" id="calories" name="calories" placeholder="50 kcal" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="amount">Amount</label>
              <div class="input-group">
                <input type="number" class="form-control" id="amount" name="amount" placeholder="50" required>
                <div class="input-group-append">
                  <select class="form-control" id="unit" name="unit" required>
                    <option value="g">g</option>
                    <option value="ml">ml</option>
                    <option value="quantity">quantity</option>
                    <option value="one meal">one meal</option>
                  </select>
                </div>
              </div>
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




    </script>
</body>
</html>
