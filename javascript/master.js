'use strict';
let coinQuery="";
const title = document.querySelector("title");
let getListings = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/map";
let getCryptos = "https://api.crypto.com/v2/public/get-instruments"
const defaultCurrency = "_USDT";
let coinList = [];
let coinList_2 =[];
let previewData =[];
let coinList__data =[];
let currentIndex = 0;
let topCoinArray = [];
let topIndex =0;
let container = $('div.topcoin_container').children();
$(container).hide();
if(title.innerText=="Cryptocurrency Tracker"){
    GetAllCryptos();
}

//Loads the approperate header depending on the page - DYNAMIC NAVBAR
function loadHeader()
{
    if(title.innerText=="Cryptocurrency Tracker")                   //If in the home page
    {
        const nav_home = document.querySelector("#nav-home");
        nav_home.remove();
        $('#mobile_nav-home').remove();
    }
    else if(title.innerText=="Cryptocurrency Tracker - News")    //If in the Markets page
    {
        const nav_markets=document.querySelector("#nav-news");
        nav_markets.remove();
        $('#mobile_nav-news').remove();
    }
    else if(title.innerText=="Cryptocurrency Tracker - Login")  
    {
        const nav_markets=document.querySelector("#nav-news");
        const nav_home = document.querySelector("#nav-home");
        const nav_logout = document.querySelector("#nav-logout");
        nav_logout.remove();
        nav_home.remove();
        nav_markets.remove();
        $('#nav-account').hide();
        $('#mobile_nav').remove();
    }
    else if(title.innerText=="Cryptocurrency Tracker - Account")
    {
        $('#nav-account').hide();
        $('#mobile_nav-account').remove();
    }
}
//
async function loadTopCoinArray()
{
    coinList__data.forEach(element=>{
         let current = `<div class="coin_name">${element.name}</div>
         <div class="coin_current">Current: ${element.current}</div>
         <div class="coin_high">High: ${element.high}</div>
         <div class="coin_volume">24H V: ${element.volume}</div>`;
        topCoinArray.push(current);
    });
    $(container).slideDown("slow");
    animateTopCoins(container);
}
//Slide show for the top performing coins
async function animateTopCoins()
{
    $(container[0]).html(topCoinArray[topIndex++]);
    $(container[1]).html(topCoinArray[topIndex++]);
    $(container[2]).html(topCoinArray[topIndex++]);
    $(container[3]).html(topCoinArray[topIndex++]);
    if(topIndex>=topCoinArray.length)
    {
        topIndex =0;
    }
    setTimeout(loadTopCoinArray, 5000);
}
//Searches the CoinList array using input enetered by the user
function SearchCoinList(coin)
{
    coin = coin.toLowerCase();
    const result = coinList.find(({name, symbol}) => name === coin || symbol === coin);
    return result;
}
//Function to get all coins and store them in a global array - USES API from coinmarketcap
async function getAllCoins(endpoint)
{
    $.ajax(
        {
            url: endpoint,
            headers: {'X-CMC_PRO_API_KEY': '5bc8691d-377f-4a2c-833a-e40a00088cea'},
            success: function (results){
                results['data'].forEach(element => {
                    let name = element['name'];
                    let symbol = element['symbol'];
                    let current = {                 //Object to store coin details then push it to the coin list array
                        "name": `${name.toLowerCase()}`,
                        "symbol": `${symbol.toLowerCase()}`
                    }
                    coinList.push(current);
                });
            },
            error: function(xhr, status){
                console.log("Error: "+ xhr.status);
            }
        })
}
export function calculateChange(open, current){
    let percent= (((current-open)/open)*100).toFixed(2);
    let tempPercent = percent.toString();
    let final = tempPercent+' %';
    return percent;
}
//Function to load the candle stick data for a coin
async function getCandleStick(url, calculateChange, coinData)
{
    console.log(url);
    fetch("./getCryptoData.php?url="+url+"&time=timeframe=1D",{method: 'GET'}).then(
        (resp)=>{
            if(!resp.ok){
                console.log(resp.statusText);
            }
            else{
                return resp.json();
            }
        }
    ).then((resp)=>{
        let results = resp['result'];
                let data = results['data'];
                let last = results['data'].length -1;
                
                //Callback function 
                let lastElement = data[last];
                let priceChage = calculateChange(lastElement.o, lastElement.c);
                if(priceChage>=0)
                {
                    let insert =`<div class="searchResult"><div>Symbol: ${coinData['symbol']}</div><div>Name: ${coinData['name']}</div></div><div class="up">24h: ${priceChage}</div><button id="addToPortFolio" type="button">Add</button>`;
                    $('div.result').html(insert);
                    $('div.result').removeClass("hidden");
                }
                else{
                    let insert =`<div class="searchResult"><div>Symbol: ${coinData['symbol']}</div><div>Name: ${coinData['name']}</div></div><div class="down">24h: ${priceChage}</div><button id="addToPortFolio" type="button" value="submit">Add</button>`;
                    $('div.result').html(insert);
                    $('div.result').removeClass("hidden");
                }
    }).catch(error=>{
            console.error(error);
        });
}
//Function to add a coin to the users list
function AddToUserList(symbol)
{
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "./usersList.php?coin="+symbol+"&func=add");
    xhr.addEventListener("load", (ev) => {
        if(xhr.status== 200)
        {
            const response = xhr.responseText;
        }
    });
    xhr.send();
}
//Function to load all coins from crypto.com api
function GetAllCryptos()
{
    fetch(`${getCryptos}`).then((resp)=>{
        if(!resp.ok)
        {
            console.error(resp.status);
        }
        else{return resp.json();}
    }).then(resp=>{
        let results = resp['result'];
        let data = results['instruments'];
        let i=0;
        data.forEach(element=>{
            let current = element['base_currency'];
            coinList_2.push(current);
        });
        coinList_2 = [...new Set(coinList_2)];
        GetAllCryptoData();
    }).catch((error) => {
        console.error('Error:', error);
      });
}
//Function to get data on all crypto.com cryptos in the coinList_2 array
function GetAllCryptoData()
{
    if(currentIndex < coinList_2.length)
    {
        let url =  `https://api.crypto.com/v2/public/get-candlestick?instrument_name=${coinList_2[currentIndex]}_USDT`;
        fetch("./getCryptoData.php?url="+url+"&time=timeframe=1D",{method: 'GET'}).then(
            (resp)=>{
                if(!resp.ok){
                    console.log(resp.statusText);
                }
                else{
                    return resp.json();
                }
            }
        ).then((resp)=>{
            let results = resp['result'];
                if(results!="")
                {
                    let data = results['data'];
                    if(data!="" && data != null){
                        let last = results['data'].length -1;
                        let lastElement = data[last];
                        //Store the data in the candle stick array
                        let current ={
                            "name": coinList_2[currentIndex],
                            "volume": (lastElement.v * lastElement.c).toFixed(2).toLocaleString("en-US"),
                            "high" : (lastElement.h).toFixed(2).toLocaleString("en-US"),
                            "current" : (lastElement.c).toFixed(2).toLocaleString("en-US")
                        }
                    coinList__data.push(current);
                    }
                }
                currentIndex+=1;
                let temp =4;
                if(currentIndex == 8)
                {
                    loadTopCoinArray();
                }
                GetAllCryptoData();
        }).catch((error)=>{
            console.error('Error:', error);
        });
    }
}
$(document).ready(function(){
    //*******CODE FOR DATE GOTTEN FROM STACK OVERFLOW******//
    let today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = mm + '/' + dd + '/' + yyyy;
    $('div.date').text("Date: "+today);
    //Load all the coins into a global array
    getAllCoins(getListings);
    //Load the approperate header
    loadHeader();
    //When the user clicks the add tp portfolio button
    $("body").on("click", "#addToPortFolio",function(){
        console.log("Adding: "+coinQuery);
        AddToUserList(coinQuery);
    });
    //Mobile Navbar event listener
    let flag = false;
    $('#mobile_icon').on('click', function(){

        $('.mobile_list').slideToggle();
    });
    //SEARCH FOR COIN EVENT LISTENER
    $('#searchbutton').click(function(){
        let searchword = document.querySelector('#searchbox').value;
        const result = SearchCoinList(searchword);
        if(result===undefined)
        {
            console.log("No results found");
        }
        else{
            coinQuery = result['symbol'];
            coinQuery = coinQuery.toUpperCase();
            let oneDay_candleStick =`https://api.crypto.com/v2/public/get-candlestick?instrument_name=${coinQuery}_USDT`;
            getCandleStick(oneDay_candleStick, calculateChange, result);
        }
    });
});//End of Domloaded event listener