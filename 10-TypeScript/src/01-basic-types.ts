const characterName: string = "Hornet"
const health: number = 100;
const canDoubleJump: boolean = false;
const tools: string[] = ["tracks", "Curveclaw", "Cogly"]
const personalData : [string, number] = ["hornet", 100];
const dynamicVariable: any = "This can be anything";


const output = document.getElementById('output');
if(output){
    output.innerHTML = 
    '<li><strong><Character:</stong> ${characterName}</li>'
    '<li><strong><Character:</stong> ${health}</li>'
    '<li><strong><Character:</stong> ${canDoubleJump}</li>'
    '<li><strong><Character:</stong> ${tools}</li>'
    '<li><strong><Character:</stong> ${personalData}</li>'
    '<li><strong><Character:</stong> ${dynamicVariable}</li>'
    
}

