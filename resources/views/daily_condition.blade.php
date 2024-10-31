<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cal-O-Lator</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
    
        <h1 class="mt-5">Every day Condition</h1>
        <div class="row justify-content-center">
        <form>
            <div class="form-group">
                <label for="icon">Today's Condition</label>
                <select class="form-control" id="icon">
                    <option value="smiley1" data-icon="{{ asset('images/img01.png') }}">
                        <img src="{{ asset('images/img01.png') }}" alt="">Smiley 1
                    </option>
                    <option value="smiley1" data-icon="{{ asset('images/img05.png') }}">
                        <img src="{{ asset('images/img05.png') }}" alt="">Smiley 1
                    </option>
                    <option value="smiley1" data-icon="{{ asset('images/img11.png') }}">
                        <img src="{{ asset('images/img11.png') }}" alt="">Smiley 1
                    </option>
                    <option value="smiley1" data-icon="{{ asset('images/img12.png') }}">
                        <img src="{{ asset('images/img12.png') }}" alt="">Smiley 1
                    </option>
                    <option value="smiley1" data-icon="{{ asset('images/img15.png') }}">
                        <img src="{{ asset('images/img15.png') }}" alt="">Smiley 1
                    </option>
                    <!-- 他のアイコンも同様に追加 -->
                </select>
            </div>
            
            <style>
                .form-control option {
                    background-repeat: no-repeat;
                    background-position: left center;
                    padding-left: 40px; /* アイコンのスペースを確保 */
                }
                .form-control option[value="smiley1"] {
                    background-image: url('C:\Users\saki\Downloads\data\data\img15.png');
                }
                .form-control option[value="smiley2"] {
                    background-image: url('path/to/smiley2.png');
                }
                /* 他のアイコンも同様にスタイルを追加 */
            </style>
            
            
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
                    <option>Running</option>
                    <option>Cycling</option>
                    <option>Swimming</option>
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
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>


<img src="{{ asset('images/img01.png') }}" alt="Smiley 1">
<img src="/images/smiley2.png" alt="Smiley 2">
