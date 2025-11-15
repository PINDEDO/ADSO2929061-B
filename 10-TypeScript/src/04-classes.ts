class Enemy {
    name: string;
    health: number;

    constructor(name: string, health: number){
        this.name = name;
        this.health = health;
    

    }

    takeDamage(damage: number): void{
        this.health -= damage;

    }
}
 
const mosskin = new Enemy('Mosskin', 30);
mosskin.takeDamage(10);

const output04 = document.getElementById('output');


if(output04){
    output04.innerHTML= 
    '<li><strong><base Damage: </stong>15</li>'
    '<li><strong><multiplier: </stong>2</li>'
    '<li><strong><Total Attack: </stong> ${attack}</li>'
}
