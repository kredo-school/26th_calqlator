<!DOCTYPE html>
<html>
<head>
    <title>Meal Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Meal Registration</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Calories</th>
                    <th>Amount</th>
                    <th>Time eaten</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($meals as $meal)
                    <tr>
                        <td>{{ $meal->item }}</td>
                        <td>{{ $meal->calories }} kcal</td>
                        <td>{{ $meal->amount }}</td>
                        <td>{{ $meal->time_eaten }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No food registered</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="text-center p-2">
        <button class="btn btn-outline-danger rounded-circle btn-sm " data-bs-toggle="modal" data-bs-target="#" title="Add">
            <i class="fa-solid fa-plus"></i>
        </button> Add Food
        </div>
        
        <form action="/search" method="GET" class="d-flex justify-content-center">
            <div class="form-group">
                <input type="text" class="form-control w-80" name="query"  placeholder="Search...">
            </div>
        </form>
        
        <h2 class="text-center">History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Calories</th>
                    <th>Per amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Example search results -->
                <tr>
                    <td>Meat Sauce Pasta</td>
                    <td>626 kcal</td>
                    <td>per serving (dry pasta 100g)</td>
                    <td><button class="btn btn-outline-danger rounded-circle btn-sm " data-bs-toggle="modal" data-bs-target="#" title="Add">
                        <i class="fa-solid fa-plus"></i>
                    </button> Add</td>
                </tr>
                <tr>
                    <td>Carbonara</td>
                    <td>589 kcal</td>
                    <td>per serving</td>
                    <td><button class="btn btn-outline-danger rounded-circle btn-sm " data-bs-toggle="modal" data-bs-target="#" title="Add"><i class="fas fa-plus"></i>
                    </button> Add</td>
                </tr>
                <!-- Add more search results as necessary -->
            </tbody>
        </table>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
          var headerCells = document.querySelectorAll("table th");
          headerCells.forEach(function(cell) {
            cell.style.borderLeft = "none";
            cell.style.borderRight = "none";
          });
          var bodyCells = document.querySelectorAll("table td");
          bodyCells.forEach(function(cell) {
            cell.style.borderLeft = "none";
            cell.style.borderRight = "none";
          });
        });
      </script>
      
      
</body>
</html>
