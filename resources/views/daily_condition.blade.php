<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cal-O-Lator</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="file:///C:/Users/saki/Documents/26th_calqlator/public/css/everyday_condition.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mt-5">Every day Condition</h1>
        <div class="row justify-content-center">
            <form>
                <div class="form-group">
                    <label for="icon">Today's Condition</label>
                    <select class="form-control" id="icon">
                        <option class="smile" value="smiley1" >😀</option>
                        <option class="smile" value="smiley2" >😏</option>
                        <option class="smile" value="smiley3" >😐</option>
                        <option class="smile" value="smiley4" >😷</option>
                        <option class="smile" value="smiley5" >😴</option>
                        <!-- 他のアイコンも同様に追加 -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (Kg)</label>
                    <input type="number" class="form-control" id="weight" placeholder="Enter your weight">
                </div>
                <div class="form-group">
                    <label for="diary">Diary</label>
                    <textarea class="form-control" id="diary" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <select class="form-control" id="icon">
                        <option>🏃</option>
                        <option>🏃‍♀️</option>
                        <option>🚴</option>
                        <option>🤺</option>
                        <option>⛷️</option>
                        <option>🏂</option>
                        <option>🏌</option>
                        <option>🏄</option>
                        <option>🏊</option>
                        <option>🏕️</option>
                        <option>🏥</option>
                        <option>🗽</option>
                        <option>♨ </option>
                        <option>🎡</option>
                        <option>🚂</option>
                        <option>🚗</option>
                        <option>✈</option>
                        <option>☃</option>
                        <option>🐶</option>
                        <option>🗽</option>
                        <option>🎶</option>




                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">OK</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
    <script src="js/app.js"></script>
    <script>
        $(document).ready(function() {
  $('#icon option').each(function() {
    var iconUrl = $(this).attr('data-icon');
    if (iconUrl) {
      $(this).html('<img src="' + iconUrl + '" style="width: 20px; height: 20px; vertical-align: middle;"> ' + $(this).text());
    }
  });
});
    </script>
</body>
</html>
