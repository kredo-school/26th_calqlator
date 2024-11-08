'use strict';

console.clear();

{
    const today = new Date();
    let year = today.getFullYear();
    let month = today.getMonth();

    function getCalendarHead(){
        const dates = [];
        const d = new Date(year, month, 0).getDate();//今月の1日は(year,month,1)なので、先月の最後の日は(year,month,0)となる
        const n = new Date(year, month, 1).getDay(); //今月の1日が何曜日か（日曜：０、月曜：１、火曜水曜:２、木曜:３、金曜:４、土曜:５　となっている）なのでそこまでの数nを取得すれば前月の日にちで表示しなければいけない日付の数がわかる

        for(let i = 0; i < n ; i++){
            dates.unshift({
                date: d-i,
                isToday: false,
                isDisabled: true,
            });
        }

        return dates;
    }

    function getCalendarBody(){
        const dates = [];
        const lastDate = new Date(year, month+1, 0).getDate();

        for(let i=1; i<=lastDate; i++){
            dates.push({
                date:i,
                isToday: false,
                isDisabled: false,
            });
        }

        if(year === today.getFullYear() && month === today.getMonth()){ //todayの年とtodayの月が同じなら、
        dates[today.getDate()-1].isToday = true; //今日の日付をtrueにする
        }

        return dates;
    }

    function getCalendarTail(){
        const dates = [];
        const lastDay = new Date(year, month + 1, 0).getDay();

        for (let i = 1; i < 7-lastDay; i++){
            dates.push({
                date:i,
                isToday: false,
                isDisabled: true,
            });
        }

        return dates;
    }

    function clearCalendar(){
        const tbody = document.querySelector('tbody'); //tbody要素を取得

        while(tbody.firstChild){ //tbody要素の子要素がある限り
            tbody.removeChild(tbody.firstChild); //tbody要素の子要素を全て削除する
        }
    }

    function renderTitle(){
        const title = `${year}/${String(month+1).padStart(2, '0')}`; //monthは0から始まるので+1する // padStart(2, '0')： は2桁で表示してね。それに満たなかったら0で埋める　//padStartは文字列にしか使えないので文字列(sring)に変換
        document.getElementById('title').textContent = title; //idがtitleの要素を取得
    }

    function renderWeeks(){
        const dates = [
            ...getCalendarHead(),
            ...getCalendarBody(),
            ...getCalendarTail()
        ];

        const weeks = [];
        const weeksCount = dates.length / 7;

        for(let i = 0; i < weeksCount; i++){
            weeks.push(dates.splice(0, 7)); //splice(0,7)　先頭から７個分のデータを取り出す
        }

        weeks.forEach(week => {
            const tr = document.createElement('tr');
            week.forEach(date => {
                const td = document.createElement('td');
                
                td.textContent = date.date;

                if(date.isToday){
                    td.classList.add('today'); //dateがisTodayならそのtd要素にtodayクラスをつける
                }

                if(date.isDisabled){
                    td.classList.add('disabled'); //dateがisDisabledならそのtd要素にdisabledクラスをつける
                }

                tr.appendChild(td); //tr要素の末尾の子要素に追加する
            });

            document.querySelector('tbody').appendChild(tr); //tbody要素の末尾の子要素にtr要素を追加する
        });
    }

    function createCalendar(){
        clearCalendar();
        renderTitle();
        renderWeeks();
    }

    document.getElementById('prev').addEventListener('click', () => { //prevボタンをクリックしたら次の処理をする
        month--; //month から1を引く
        if(month < 0){ //年を跨いだときの処理。月が0(1月)より小さくなったら、
            year--; //年を1減らす
            month = 11; //月を11（12月）にする
        }
        createCalendar();
    });

    document.getElementById('next').addEventListener('click', () => { //nextボタンをクリックしたら次の処理をする
        month++; //monthに１を加える
        if(month > 11){ //年を跨いだときの処理。月が11（12月）より大きくなったら、
            year++; //年を1増やす
            month = 0; //月を0（1月）にする
        }
        createCalendar();
    });
    
    document.getElementById('today').addEventListener('click', () => { //nextボタンをクリックしたら次の処理をする
        year = today.getFullYear(); //yearをtodayの年にする
        month = today.getMonth(); //monthをtodayの月にする

        createCalendar();
    });

    createCalendar();
}