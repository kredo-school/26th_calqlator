@extends('layouts.app')

@section('title', 'Calendar')

@section('content')
<body>
    <table>
        <thead>
            <tr>
                <th id="prev" colspan="2">&laquo;</th>
                <th id="title" colspan="3">2020/05</th>
                <th id="next" colspan="2">&raquo;</th>
            </tr>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <td id="today" colspan="7">Today</td>
            </tr>
        </tfoot>
    </table>
    <script src="../js/calendar.js"></script>
</body>
@endsection