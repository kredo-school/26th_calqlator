@extends('layouts.user')


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/workout.style.css') }}">
</head>
<body>
    <div class="container mt-5">
      <div class="underline-container">
        <h2 class="underline text-left">Workout Registration</h2>
      </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Exercise</th>
                    <th>Calories</th>
                    <th>min</th>
                    <th>Total Calories</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($workouts as $workout)
                    <tr>
                        <td>{{ $workout->Exercise }}</td>
                        <td>{{ $workout->calories }} kcal</td>
                        <td>{{ $workout->min }}</td>
                        <td>{{ $workout->Total_Calories }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Workout registered</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="text-center p-2">
            <button class="btn btn-outline-danger rounded-circle btn-sm" data-toggle="modal" data-target="#addWorkoutModal" title="Add">
                <i class="fa-solid fa-plus"></i>
            </button> Add Workout
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
                    <th>Exercise</th>
                    <th>Calories</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Example search results -->
                <tr>
                    <td>Running(fast : 14.5km/hr)</td>
                    <td>about 159 kcal/10 min</td>
                    <td><button class="btn btn-outline-danger rounded-circle btn-sm" data-toggle="modal" data-target="#addWorkoutModal" title="Add">
                        <i class="fa-solid fa-plus"></i>
                    </button> Add</td>
                </tr>
                <tr>
                    <td>Yoga</td>
                    <td>about 31 kcal/10 min</td>
                    <td><button class="btn btn-outline-danger rounded-circle btn-sm" data-toggle="modal" data-target="#addWorkoutModal" title="Add"><i class="fas fa-plus"></i>
                    </button> Add</td>
                </tr>
                <!-- Add more search results as necessary -->
            </tbody>
        </table>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="addWorkoutModal" tabindex="-1" aria-labelledby="addWorkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content  text-center">
      <div class="modal-header">
        <h5 class="modal-title" id="addWorkoutModalLabel">Register my own excercise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addWorkoutForm" action="{{ route('workouts.store') }}" method="POST">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="item">Excercise Name</label>
              <input type="text" class="mborder form-control" id="item" name="item" placeholder="Running" required>
            </div>
            <div class="form-group col-md-6">
              <label for="calories">Calories per 10 minutes</label>
              <input type="number" class="mborder form-control" id="calories" name="calories" placeholder="50 kcal" required>
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
