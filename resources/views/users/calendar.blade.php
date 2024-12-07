@extends('layouts.calendar')

@section('title', 'Calendar')

@section('content')
<table id="calendar">
    <thead>
        <tr>
            <th id="prev"  colspan="2"></th>
            <th colspan="3" class="top"> 
                <div class="row">
                    <div class="col" id="title">
                    </div>
                    <div class="col p-0">
                        <p class="row h-50 align-items-end" id="year"></p> 
                        <p class="row h-50" id="monthName"></p> 
                    </div> 
                </div>
            </th>
            <th id="next" colspan="2"></th>
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
            <td id="today" colspan="7" class="text-center text-decoration-underline text-primary">Go back to today</td>
        </tr>
    </tfoot>
</table>
@endsection