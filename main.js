// alle variabelen aanmaken
let dealer_number = 0;
let player_number = 0;



let hidden;
let deck;

let result = "";
let wins = 0;
let losses = 0;
let pushes = 0;

let can_hit = true;

// zodra de game wordt geopend worden deze 3 functions aangemaakt
window.onload = function () {
    build_deck();
    shuffle_deck();
    start_game();
}

// hier worden alle kaarten gelijkgezet aan de foto in de map assets
function build_deck() {
    let values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
    let types = ["C", "D", "H", "S"];
    deck = [];

    for (let i = 0; i < types.length; i++) {
        for (let j = 0; j < values.length; j++) {
            deck.push(values[j] + "-" + types[i]);
        }
    }
    //console.log(deck);
}

// hier worden alle kaarten random gekozen om op de tafel te komen
function shuffle_deck() {
    for (let i = 0; i < deck.length; i++) {
        let j = Math.floor(Math.random() * deck.length);
        let temp = deck[i];
        deck[i] = deck[j];
        deck[j] = temp;
    }
    console.log(deck)
}

// de game begint en telt de dealer zijn punten en zet de kaarten in een nieuwe image tag
// deck.pop uitleg vragen!!!
function start_game() {
    hidden = deck.pop();
    dealer_number += get_value(hidden);
        let card_image = document.createElement("img");
        let card = deck.pop();
        card_image.src = "./assets/cards/" + card + ".png";
        dealer_number += get_value(card);
        document.getElementById("dealer_cards").append(card_image);

    console.log(dealer_number);

    // precies hetzelfde als hierboven maar dan voor de player
    for (let i = 0; i < 2; i++) {
        let card_image = document.createElement("img");
        let card = deck.pop();
        card_image.src = "./assets/cards/" + card + ".png";
        player_number += get_value(card);
        document.getElementById("player_cards").append(card_image);
    }
    console.log(player_number);
    document.getElementById("hit").addEventListener("click", hit);
    document.getElementById("stand").addEventListener("click", stand);
}

// hier is de functie "hit", als je kan hitten dan komt er een kaart bij je deck, als je niet kan hitten dan gebeurt er niets
function hit() {
    if (!can_hit) {
        return;
    }
    let card_image = document.createElement("img");
    let card = deck.pop();
    card_image.src = "./assets/cards/" + card + ".png";
    player_number += get_value(card);
    document.getElementById("player_cards").append(card_image);

    if (player_number > 20) {
        can_hit = false;
    }
}

// hier is de functie "stand", dan gaan de punten opgeteld worden en gekeken of er iemand een aas heeft
function stand() {
    while (dealer_number < 17) {
        let card_image = document.createElement("img");
        let card = deck.pop();
        card_image.src = "./assets/cards/" + card + ".png";
        dealer_number += get_value(card);
        document.getElementById("dealer_cards").append(card_image);

    }

    can_hit = false;
    document.getElementById("hidden").src = "./assets/cards/" + hidden + ".png";

    // hier gaan we kijken of je gewonnen of verloren hebt
    let message = "";
    if (player_number > 21) {
        message = "You lose!";
        losses++
        result = "loss";
    } else if (dealer_number > 21) {
        message = "You win!"
        wins++
        result = "win";
    } else if (player_number === dealer_number) {
        message = "Push!"
        pushes++
        result = "push"
    } else if (player_number > dealer_number) {
        message = "You win!"
        wins++
        result = "win";
    } else if (player_number < dealer_number) {
        message = "You lose!"
        losses++
        result = "loss";
    }
    // hier zetten we de scores in de <span> in HTML
    document.getElementById("dealer_number").innerText = dealer_number;
    document.getElementById("player_number").innerText = player_number;
    document.getElementById("result").innerText = message;
}

// geven we elke soort kaart een waarde van een integer
function get_value(card) {
    let data = card.split("-")
    let value = data[0];

// als value geen nummer is geef dan aas 11 als waarde, en de andere 10 als waarde
    if (isNaN(value)) { // kan A, J, Q of K zijn
        if (value === "A") {
            return 11;
        }
        return 10;
    }
    return parseInt(value);
}

function reload() {
    location.reload()
}
