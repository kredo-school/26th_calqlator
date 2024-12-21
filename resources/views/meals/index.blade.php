<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Meal Registration Morning</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/css/meal.style.css') }}">
</head>
<body>
  <nav class="navbar navbar-expand-md py-0 px-5" role="navigation">
    @guest
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('/assets/images/logo.png') }}" alt="Cal-Q-Lator" class="logo">
        </a>
    @else
        <a class="navbar-brand" href="{{ route('user.home', $date=now()->format('Y-m-d')) }}">
            <img src="{{ asset('/assets/images/logo.png') }}" alt="Cal-Q-Lator" class="logo">
        </a>
    @endguest

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link calendar-link" href="{{ route('user.calendar') }}">
                        C<img src="{{asset('/images/a-img.png')}}" alt="a" class="a-img">lend<img src="{{asset('/images/a-img.png')}}" alt="a" class="a-img">r
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle shadow-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           Menu 
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                         <a href="{{route('user.home',$date=now()->format('Y-m-d'))}}" class="dropdown-item">
                            Home
                        </a>
                         <a href="{{route('user.profile')}}" class="dropdown-item calendar-link">
                            My P<img src="{{asset('/images/a-img.png')}}" alt="a" class="dropdown-a-img">ge
                        </a>
                         <a href="{{route('user.edit')}}" class="dropdown-item calendar-link">
                            User Inform<img src="{{asset('/images/a-img.png')}}" alt="a" class="dropdown-a-img">tion
                        </a>

                        <hr class="dropdown-divider">

                        <a class="nav-link logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form> 

                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
  <div class="container mt-5">
    <div class="underline-container">
      <h2 class="underline text-left">Meal Registration Morning</h2>
    </div>
    <form id="mealForm" action="{{ route('meals.store') }}" method="POST">
      @csrf
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
                  <th>Date</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td colspan="8" class="text-center">No food registered</td>
              </tr>
          </tbody>
      </table>
      <div class="text-center p-2">
          <button type="submit" class="btn btn-outline-primary">Save</button>
      </div>
  </form>
    <div class="text-center p-2">
      <button class="btn btn-outline-danger rounded-circle btn-sm" data-toggle="modal" data-target="#addFoodModal" title="Add">
        <i class="fa-solid fa-plus"></i>
      </button> Add Food
    </div>
    <form id="searchForm" action="{{ route('meals.search') }}" method="POST" class="d-flex justify-content-center">
      @csrf
      <div class="form-group">
        <input type="text" class="form-control w-80" name="query" placeholder="Search...">
      </div>
    </form>
    <h2 class="history text-center">History</h2>
    <table class="table table-bordered" id="historyTable">
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
        <!-- JavaScriptでデータを挿入 -->
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
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addFoodForm">
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
                <label for="time_eaten">Time eaten</label>
                <input type="time" class="mborder form-control" id="time_eaten" name="time_eaten" placeholder="19:30" required>
              </div>
              <div class="form-group col-md-6">
                <label for="protein">Protein</label>
                <input type="number" class="mborder form-control" id="protein" name="protein" placeholder="50 kcal" required>
              </div>
              <div class="form-group col-md-6">
                <label for="carbohydrate">Carbohydrate</label>
                <input type="number" class="mborder form-control" id="carbohydrate" name="carbohydrate" placeholder="50 kcal" required>
              </div>
              <div class="form-group col-md-6">
                <label for="lipid">Lipid</label>
                <input type="number" class="mborder form-control" id="lipid" name="lipid" placeholder="50 kcal" required>
              </div>
              <div class="form-group col-md-6">
                 <label for="date">Date</label>
                 <input type="date" class="mborder form-control" id="date" name="date" required>
              </div>

            </div>
            <button type="button" class="btn btn-outline-primary" id="addFoodButton">ADD</button>
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
    document.getElementById('addFoodButton').addEventListener('click', function() {
      const item = document.getElementById('item').value;
      const calories = document.getElementById('calories').value;
      const amount = document.getElementById('amount_value').value + ' ' + document.getElementById('amount_unit').value;
      const timeEaten = document.getElementById('time_eaten').value;
      const protein = document.getElementById('protein').value;
      const carbohydrate = document.getElementById('carbohydrate').value;
      const lipid = document.getElementById('lipid').value;
      const date = document.getElementById('date').value;

      const newRow = `
        <tr>
          <td><input type="hidden" name="item[]" value="${item}">${item}</td>
          <td><input type="hidden" name="calories[]" value="${calories}">${calories}</td>
          <td><input type="text" name="amount[]" value="${amount}" class="form-control"></td>
          <td><input type="time" name="time_eaten[]" value="${timeEaten}" class="form-control"></td>
          <td><input type="number" name="protein[]" value="${protein}" class="form-control"></td>
          <td><input type="number" name="carbohydrate[]" value="${carbohydrate}" class="form-control"></td>
          <td><input type="number" name="lipid[]" value="${lipid}" class="form-control"></td>
          <td><input type="date" name="date[]" value="${date}" class="form-control"></td>
        </tr>
      `;

      const mealTableBody = document.querySelector('#mealTable tbody');
      if (mealTableBody.querySelector('tr td[colspan="8"]')) {
        mealTableBody.innerHTML = ''; // "No food registered" をクリア
      }
      mealTableBody.insertAdjacentHTML('beforeend', newRow);
      $('#addFoodModal').modal('hide');
    });

    document.addEventListener('DOMContentLoaded', function() {
      fetch('/meals/history')
        .then(response => response.json())
        .then(data => {
          const historyTableBody = document.querySelector('#historyTable tbody');
          historyTableBody.innerHTML = ''; // 既存の内容をクリア
          data.forEach(meal => {
            const newRow = `
            <tr>
              <td>${meal.item}</td>
              <td>${meal.calories} kcal</td>
              <td>${meal.amount}</td>
              <td>${meal.protein} kcal</td>
              <td>${meal.carbohydrate} kcal</td>
              <td>${meal.lipid} kcal</td>
              <td><button class="btn btn-outline-danger rounded-circle btn-sm add-to-meal" data-id="${meal.id}" data-item="${meal.item}" data-calories="${meal.calories}" data-amount="${meal.amount}" title="Add">
                <i class="fa-solid fa-plus"></i>
              </button> Add</td>
            </tr>
          `;
          historyTableBody.insertAdjacentHTML('beforeend', newRow);
        });

        document.querySelectorAll('.add-to-meal').forEach(button => {
          button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const item = this.getAttribute('data-item');
            const calories = this.getAttribute('data-calories');
            const amount = this.getAttribute('data-amount');
            const date = this.getAttribute('data-date');

            // 上の表に追加
            const newRow = `
              <tr>
                <td>${item}</td>
                <td><input type="hidden" name="calories[]" value="${calories}" class="form-control">${calories} kcal</td>
                <td><input type="text" name="amount[]" value="${amount}" class="form-control"></td>
                <td><input type="time" name="time_eaten[]" value="" class="form-control"></td>
                <td><input type="number" name="protein[]" value="" class="form-control"></td>
                <td><input type="number" name="carbohydrate[]" value="" class="form-control"></td>
                <td><input type="number" name="lipid[]" value="" class="form-control"></td>
                <td><input type="date" name="date[]" value="${date}" class="form-control"></td>
              </tr>
            `;

            const mealTableBody = document.querySelector('#mealTable tbody');

            if (mealTableBody.querySelector('tr td[colspan="8"]')) {
              mealTableBody.innerHTML = ''; // "No food registered" をクリア
            }
            mealTableBody.insertAdjacentHTML('beforeend', newRow);
          });
        });
      });

      


//       document.getElementById('mealForm').addEventListener('submit', function(event) {
//     event.preventDefault(); // フォームのデフォルト送信を防ぐ

//     const formData = new FormData(this);
//     const totalCalories = calculateTotalCalories(); // 総カロリーを計算
//     formData.append('totalCalories', totalCalories); // 総カロリーを追加

//     fetch(this.action, {
//         method: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: formData, // フォームデータを送信
//     }).then(response => {
//         if (!response.ok) {
//             return response.text().then(text => { throw new Error(text); });
//         }
//         return response.json(); // サーバーからのレスポンスをJSONとして解析
//     }).then(data => {
//         if (data.success) {
//             // 登録が成功した場合、confirmation_morningページへリダイレクト
//             window.location.href = "{{ route('meals.confirmation_morning') }}?totalCalories=" + totalCalories;
//         } else {
//             alert('Failed to save meal: ' + data.message);
//         }
//     }).catch(error => {
//         console.error('Error:', error);
//         alert('An error occurred while saving the meal.');
//     });
// });


//       document.getElementById('mealForm').addEventListener('submit', function(event) {
//     event.preventDefault();

//     const formData = new FormData(this);
//     const totalCalories = calculateTotalCalories();
//     formData.append('totalCalories', totalCalories);

//     fetch(this.action, {
//         method: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: formData,
//     }).then(response => {
//         if (!response.ok) {
//             return response.text().then(text => { throw new Error(text); });
//         }
//         return response.json();
//     })
//     .then(data => {
//        console.log(data);//サーバーからのレスポンスをログに出力
//         if (data.success) {
//             alert('Meal updated successfully.');
//             window.location.href = "{{ route('meals.confirmation_morning') }}?totalCalories=" + totalCalories;
//         } else {
//           alert('Failed to update meal: ' + data.message); // エラーメッセージを表示
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);// ネットワークエラーやその他のエラーをログに出力
//         alert('An error occurred while updating the meal.');
//     });
// });

function calculateTotalCalories() {
    let totalCalories = 0;
    document.querySelectorAll('#mealTable tbody tr').forEach(row => {
        const calories = parseInt(row.querySelector('td:nth-child(2)').textContent);
        totalCalories += calories;
    });
    return totalCalories;
}
    });

    document.getElementById('searchForm').addEventListener('submit', function(event) {
      event.preventDefault();//ページリロードを防ぐ
      const query = document.querySelector('input[name="query"]').value;

      fetch('/meals/search', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ query: query })
      })
      .then(response => {
        if (!response.ok) {
          return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
      })
      .then(data => {
        const historyTableBody = document.querySelector('#historyTable tbody');
        historyTableBody.innerHTML = ''; // 既存の内容をクリア

        if (data.length === 0) {
          historyTableBody.innerHTML = '<tr><td colspan="7" class="text-center">No results found</td></tr>';
        } else {
          data.forEach(meal => {
            const newRow = `
              <tr>
                <td>${meal.item}</td>
                <td>${meal.calories} kcal</td>
                <td>${meal.amount}</td>
                <td>${meal.protein} kcal</td>
                <td>${meal.carbohydrate} kcal</td>
                <td>${meal.lipid} kcal</td>
                <td><button class="btn btn-outline-danger rounded-circle btn-sm add-to-meal" data-item="${meal.item}" data-calories="${meal.calories}" data-amount="${meal.amount}" data-protein="${meal.protein}" data-carbohydrate="${meal.carbohydrate}" data-lipid="${meal.lipid}" title="Add">
                  <i class="fa-solid fa-plus"></i>
                </button> Add</td>
              </tr>
            `;
            historyTableBody.insertAdjacentHTML('beforeend', newRow);
          });

          // Addボタンのイベントリスナーを再設定
          document.querySelectorAll('.add-to-meal').forEach(button => {
            button.addEventListener('click', function() {
              const item = this.getAttribute('data-item');
              const calories = this.getAttribute('data-calories');
              const amount = this.getAttribute('data-amount');
              const protein = this.getAttribute('data-protein');
              const carbohydrate = this.getAttribute('data-carbohydrate');
              const lipid = this.getAttribute('data-lipid');
              const date = this.getAttribute('data-date');

              // 上の表に追加
              const newRow = `
                <tr>
                  <td>${item}</td>
                  <td>${calories} kcal</td>
                  <td><input type="text" name="amount" value="${amount}" class="form-control"></td>
                  <td><input type="time" name="time_eaten" value="" class="form-control"></td>
                  <td><input type="number" name="protein" value="${protein}" class="form-control"></td>
                  <td><input type="number" name="carbohydrate" value="${carbohydrate}" class="form-control"></td>
                  <td><input type="number" name="lipid" value="${lipid}" class="form-control"></td>
                  <td><input type="date" name="date[]" value="${date}" class="form-control"></td>
                </tr>
              `;

              const mealTableBody = document.querySelector('#mealTable tbody');
              if (mealTableBody.querySelector('tr td[colspan="8"]')) {
                mealTableBody.innerHTML = ''; // "No food registered" をクリア
              }
              mealTableBody.insertAdjacentHTML('beforeend', newRow);
            });
          });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while searching for meals.');
      });
    });
  </script>
  @include('user-guest-footer')
</body>
</html>