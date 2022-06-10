//Function to load 24hr changes for users coins
function load24HrChange(coinName, calculateChange)
{
    console.log(coinName[0].textContent);
    let fecthUrl = `https://api.crypto.com/v2/public/get-candlestick?format=json&jsoncallback=?&instrument_name=${coinName[0].textContent}_USDT&timeframe=1D`;
    console.log(fecthUrl);
    $.ajax(
        {
            url: fecthUrl,
            type: 'GET',
            success: function(result){
                let results = result['result'];
                let data = results['data'];
                let last = results['data'].length -1;
                
                //Callback function 
                let lastElement = data[last];
                let priceChange = calculateChange(lastElement.o, lastElement.c);
                if(priceChange>=0)
                {
                    $(coinName[2]).addClass("up");
                    $(coinName[2]).text("24h: "+priceChange +"%");
                    $(coinName[1]).html("Current Price: &#36;"+(lastElement.c).toFixed(2).toLocaleString("en-US"));
                }
                else{
                    $(coinName[2]).addClass("down");
                    $(coinName[2]).text("24h: "+priceChange+"%");
                    $(coinName[1]).html("Current Price: &#36; "+(lastElement.c).toFixed(2).toLocaleString("en-US"));
                }
            },
        }
    );
}
//Function to remove coin from user list
function removeCoin(coinToRemove)
{
    let coin = $(coinToRemove).text();
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "./usersList.php?coin="+coin+"&func=remove");
    xhr.addEventListener("load", (ev) => {
        if(xhr.status== 200)
        {
            const response = xhr.responseText;
        }
    });
    xhr.send();
}

$(document).ready(function(){

    let coinList = $(".crypto_list").children();
    let tempCoinName = coinList[0];
    for(let i =0; i< coinList.length; i++)
    {
        load24HrChange($(tempCoinName).children(), calculateChange);
        tempCoinName = $(tempCoinName).next();
    }
    //If remove coin was clicked 
    $('.remove_coin').on('click', (event)=>{
        //remove the parent node then the coin from the user database
        let parentNode = event.target.parentElement.parentElement;
        let coinToRemove = $(parentNode).children();
        $(parentNode).remove();
        removeCoin(coinToRemove[0]);
    });
});