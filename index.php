<!--

ZzArt - Abstract Art Evolution
© Frank Force 2019

code credits 
- download.js v4.21, by dandavis; 2008-2018. [MIT] see http://danml.com/download.html for tests/usage
- Smooth HSV by iq - https://www.shadertoy.com/view/MsS3Wc
- github-corners by Tim Holman - https://github.com/tholman/github-corners

-->

<!doctype html>
<html>

<head>
<style>

body,select { font-size: 20px; font-family: monospace; color: #FFF; }
input     { font-size: 20px; }
a         { color:#5AF; }
a:visited { color:#A5A; }
canvas    { background-color: #FFF; }
div.satellite
{
    display:none;
    z-index:100;
    position:relative;
    -webkit-text-fill-color: white; 
    -webkit-text-stroke-width: 1px; 
    -webkit-text-stroke-color: black; 
}
button, #button_share    
{ 
    margin: 10px; 
    font-size: 30px; 
    vertical-align: middle; 
    text-align: center; 
    border-radius: 10px;
    background-color: #EEE; 
    height:45px;
}
button.satellite
{
    background-color: #FFF; 
    -webkit-text-fill-color: black; 
    -webkit-text-stroke-width: 1px; 
    color: #000;
    font-size: 30px;
    margin-top: 0px;
    margin-right: 0px;
    margin-left: 0px;
    padding: 2px;
    width:45px;
    height:45px;
    border-radius: 10px;
}
</style>
<title>ZzArt - Abstract Art Evolution</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.png"/>
<meta name="author" content="Frank Force">
<meta charset="utf-8">
</head>
<body bgcolor="#222">
<tag autocomplete=off autocorrect=off autocapitalize=off spellcheck=false/>
<div id=div_satellite class=satellite>
<button id=button_satelliteHelp class=satellite onclick=ButtonSatelliteHelp() title="Help">📡</button>
<button id=button_satelliteSave class=satellite onclick=ButtonSave() title="Save HD Image [S]">💾</button>
<font size=10><b>𝓩𝔃𝓐𝓻𝓽</b> - <span id=span_generationsSatellite>0</span></font><br></div>
<center>
<div id=div_title><font size=5><b>𝓩𝔃𝓐𝓻𝓽</b></font> - <span id=span_generations>0</span></div>
<div id=buttons_top>
<button id=button_preview disabled onclick=ButtonTogglePreview() title="Toggle Preview [Spacebar]">🔍</button>
<button id=button_back disabled onclick=ChangeMemoryLocation(-1) title="Undo [Z]">◄</button>
<button id=button_forward disabled onclick=ChangeMemoryLocation(1) title="Redo [X]">►</button>
<button id=button_save onclick=ButtonSave() title="Save HD Image [S]">💾</button>
<button id=button_randomize onclick=ButtonRandomize() title="Randomize [R]">🎲</button>
<!-- old
<button id=button_share hidden onclick=ButtonShare() title="Copy To Clipboard">📋</button>
-->
<form action="./share.php" style="display: inline;" method="POST">
<input name="parameters" type=text id=share_parameters hidden=""></input>
<input type=submit id=button_share title="Share" value="🔗"></input>
</form>
<button id=button_seed onclick=ButtonSeed() title="Enter Seed">🌱</button>
<button id=button_openSatellite onclick=ButtonSatellite() title="Open Satellite Preview">📡</button>
<button id=button_advanced onclick=ButtonAdvanced() title="Advanced Controls">🔧</button>
<button id=button_help onclick=ButtonHelp() title="Help">❓</button>
<br></div>
<canvas id=canvas_main width=1920 height=1080 style="width:1280px; height:720px; border:2px solid black;"></canvas>
<canvas id=canvas_shader hidden style="width:1280px; height:720px; border:2px solid black;"></canvas>
<canvas id=canvas_save hidden style="width:1280px; height:720px; border:2px solid black;"></canvas>
<br>
<div id=div_credit><font size=3>ZzArt © <a href="http://www.frankforce.com" target="_blank">Frank Force</a> 2019 ☮♥☻␌</font></div>
<div id=div_advanced style="display:none;"><hr><table><tr>
<td>
<center>Shadertoy Compatible GLSL Code
<br><textarea disabled id=textarea_code rows=20 cols=80></textarea>
<br><textarea disabled hidden id=textarea_debug style="color:#F00;" rows=4 cols=160></textarea></center>
</td>
<td style='font-size: 20px; line-height: 40px;'><center>
<input id=checkbox_hideWatermark onclick=UpdateUI() type=checkbox title="Toggle Watermark">Hide Watermark
<br>Save Canvas Scale: <input type=number id=input_saveScale style='width:50px;height:20px;' value=2>
<br>Start Iterations: <input type=number id=input_startIterations style='width:50px;height:20px;' value=1>
<br>Max Iterations: <input type=number id=input_maxIterations style='width:50px;height:20px;' value=5>
<br>Randomize Length: <input type=number id=input_randomizeLength style='width:50px;height:20px;' value=10>
<br><button id=button_capjs onclick=OpenCapJS()>Open in CapJS</button>
<br><button id=button_saveCode onclick=SaveCode()>Save Code</button>
</center></td></tr></table></div>
</center>
<a href="https://github.com/KilledByAPixel/ZzArt" target="_blank" class="github-corner" aria-label="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#5AF; color:#222; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
<script>

"use strict"; // strict mode

///////////////////////////////////////////////////////////////////////////////////////////////////////////

// global variables    
let canvasContext_main = canvas_main.getContext('2d');
let canvasContext_save = canvas_save.getContext('2d');
let canvasContext_shader = canvas_shader.getContext('webgl');
let defaultCanvasWidth = canvas_main.width;
let defaultCanvasHeight =  canvas_main.height;
let shaderMemory = [];
let shaderGrid = [];
let gridSize = 5;
let favoriteShader = 0; 
let shaderMemoryLocation = 0;
let showPreview = 0;
let advancedMode = 0;
let rotateCanvas = 0;
let dataVersion = 1;
let itchMode = 0;
let satelliteMode = 0;
let maxIterations = 1;
let startIterations = 1;

function Init()
{    
	InitWebgl();
    shaderMemory.push(new ShaderObject());
    for(let X=0; X<gridSize; X++)
        shaderGrid[X] = [];
    
    if (!itchMode)
        LoadFromURL();
	
	// handle the error
	if (window.location.href.indexOf("?error") > -1) {
		alert("There was an error while parsing the data.");
	}
	
    LoadLocalStorage();
    
    if (satelliteMode)
        InitSatelliteMode();
    else
    {
        if (favoriteShader)
        {
            shaderMemory[shaderMemoryLocation] = favoriteShader;
            SetFavoriteFromMemory();
        }
        else
            RandomizeShaders();
            
        if (!itchMode && IsMobile())
            TryToRotate();
            
        DrawShaders();
        UpdateUI();
    }
}

function InitSatelliteMode()
{
    // redraw the favorite shader
    canvas_shader.width = canvas_main.width;
    canvas_shader.height = canvas_main.height;
    favoriteShader.randSeed = 0;
       
    // set ui for satellite mode
    canvas_shader.style = 'position:absolute; left:0px; top:0px;width:100%;height:100%'
    canvas_shader.style.zIndex = 10;
    canvas_main.hidden = 1;
    canvas_shader.hidden = 0;
    buttons_top.style.display = 'none';
    div_credit.style.display = 'none';
    div_title.style.display = 'none';
    div_title.style.display = 'none';
    div_satellite.style.display = 'inline';
    
    UpdateSatelliteMode();
    setInterval(UpdateSatelliteMode, 100);
}

function UpdateSatelliteMode()
{ 
    // continuous poll favorite from local storage
    let localStorageItem = localStorage.getItem('favorite');
    if (localStorageItem)
    {
        let rawObject = JSON.parse(localStorageItem);
        if (rawObject.randSeed != favoriteShader.randSeed)
        {
            // redraw new favorite
            favoriteShader = Object.assign(new ShaderObject(), rawObject).Clone();
            favoriteShader.Render();
            span_generationsSatellite.innerHTML = favoriteShader.GetGenerationString();
        }
    }
}

function TryToRotate()
{
    // rotate canvas if window is more vertical then horizontal
    let newRotateCanvas = window.innerHeight > window.innerWidth;
    if (rotateCanvas == newRotateCanvas)
        return;
        
    rotateCanvas = newRotateCanvas;
    if (rotateCanvas)
    {
        canvas_main.width = defaultCanvasHeight;
        canvas_main.height = defaultCanvasWidth;
    }
    else
    {
        canvas_main.width = defaultCanvasWidth;
        canvas_main.height = defaultCanvasHeight;
    }
}

function RandomizeShaders()
{
    SaveLocalStorage();
    
    favoriteShader = new ShaderObject();
    for(let i=9;i--;) Rand(); // warm up random number generator
    
    for(let X=0; X<gridSize; X++)
    for(let Y=0; Y<gridSize; Y++)
    {
        let shader = shaderGrid[X][Y] = favoriteShader.Clone();
        shader.SetGridPos(X,Y);
        shader.Randomize();
    }
}

function DrawShaders()
{
    let x = canvasContext_main;
    let c = canvas_main;
    c.width|=0;
    
    let gap = 10;
    let G = gridSize;
    let SX = (c.width-gap)/G;
    let SY = (c.height-gap)/G;
    let W = (c.width - gap*(gridSize+1))/G;
    let H = (c.height - gap*(gridSize+1))/G;
    
    // use small hight for previews
    canvas_shader.width = W;
    canvas_shader.height = H;
    
    for(let X=0; X<G; X++)
    for(let Y=0; Y<G; Y++)
    {
        let shader = shaderGrid[X][Y];
        shader.Render();
        
        let posX = gap+SX*X;
        let posY = gap+SY*Y;
        x.drawImage(canvas_shader, posX, posY, W, H);
        x.beginPath()
        x.rect(posX,posY,W,H);
        x.lineWidth=2;
        x.strokeStyle='#000';
        x.stroke();
    }
        
    if (favoriteShader.gridPosX >=0 && favoriteShader.gridPosY >=0)
    {
        let posX = gap+SX*favoriteShader.gridPosX;
        let posY = gap+SY*favoriteShader.gridPosY;
        x.beginPath()
        x.rect(posX-gap/2,posY-gap/2,W+gap,H+gap);
        x.lineWidth=7;
        x.strokeStyle='#f00';
        x.stroke();
    }
}

function SetBest(bestX, bestY)
{
    favoriteShader = shaderGrid[bestX][bestY];
    favoriteShader.randSeed = randSeed;
    
    ++favoriteShader.subGeneration;
    if (favoriteShader.generation == 0)
        ++favoriteShader.generation;
    
    ++shaderMemoryLocation;
    shaderMemory.length = shaderMemoryLocation;
    shaderMemory.push(favoriteShader.Clone());
    
    MakeVariations(bestX, bestY);
    DrawShaders();
    UpdateUI();
}

function MakeVariations(skipX, skipY)
{
    textarea_code.value = favoriteShader.GetCode();
        
    for(let X=0; X<gridSize; X++)
    for(let Y=0; Y<gridSize; Y++)
    {
        let shader = shaderGrid[X][Y] = favoriteShader.Clone();
        shader.SetGridPos(X,Y);
        
        if (X!=skipX || Y!=skipY)
            shader.Mutate();
    }
}

function SetFavoriteFromMemory()
{
    favoriteShader = shaderMemory[shaderMemoryLocation];
    randSeed = favoriteShader.randSeed;
    randSeedString = favoriteShader.randSeedString;
    
    if (favoriteShader.IsVariation())
    {
        if (favoriteShader.gridPosX >= gridSize || favoriteShader.gridPosY >= gridSize)
            favoriteShader.gridPosX = favoriteShader.gridPosY = 0;
    
        let X = favoriteShader.gridPosX;
        let Y = favoriteShader.gridPosY;
        
        shaderGrid[X][Y] = favoriteShader.Clone();
        MakeVariations(X, Y);
    }
    else
        RandomizeShaders();
        
    randSeedString = '';
}

///////////////////////////////////////////////////////////////////////////////
// SHADER OBJECT

class ShaderObject
{
    constructor()
    {
        this.shaderStatements = [];
        this.randSeed = randSeed;
        this.randSeedString = randSeedString.length? randSeedString : ''+randSeed;
        this.iterationCount = 1;
        this.gridPosX = -1;
        this.gridPosY = -1;
        this.generation = 0;
        this.subGeneration = 0;
        this.hueOffset = 0;
        this.hueScale = 1;
        this.saturationScale = 1;
        this.uvOffsetX = 0;
        this.uvOffsetY = 0;
        this.uvScaleX = 1;
        this.uvScaleY = 1;
        this.rotate = 0;
        this.usePalette = 0;
        this.paletteColors = [new Vector3(), new Vector3(), new Vector3(), new Vector3()];
    }
    
    SetGridPos(X,Y) { this.gridPosX = X; this.gridPosY = Y; }
    IsVariation() { return this.gridPosX >= 0; }
    
    Randomize()
    {
        let statementCount = input_randomizeLength.value;
        if (statementCount <0)
            statementCount = 0;
        
        this.usePalette = 1;
        this.hueOffset = Rand();
        this.hueScale = RandBetween(-1,1);
        this.saturationScale = Rand();
        this.generation = 0;
        this.subGeneration = 0;
        this.shaderStatements = [];
        this.uvOffsetX = RandBetween(-1,1);
        this.uvOffsetY = RandBetween(-1,1);
        this.uvScaleX = RandBetween(-1,1);
        this.uvScaleY = RandBetween(-1,1);
        this.iterationCount = startIterations;
        for(let i=statementCount; i--;)
        {
            let statement = new ShaderStatement();
            statement.Randomize();
            this.shaderStatements.push(statement);
        }
        
        for(let color of this.paletteColors)
            color.Randomize(0,1);
    }
    
    Clone() 
    {
        let clone = Object.assign(new ShaderObject(), this);
        clone.shaderStatements = [];
        for(let statement of this.shaderStatements)
            clone.shaderStatements.push(Object.assign(new ShaderStatement(), statement));
        clone.paletteColors = [];
        for(let color of this.paletteColors)
            clone.paletteColors.push(Object.assign(new Vector3(), color));
        return clone;
    }
    
    Mutate() 
    {   
        this.subGeneration = 0;
        ++this.generation;
        
        if (this.shaderStatements.length <= 2)
        {
            this.Randomize();
            return;
        }
        
        if (Rand() < .3)
        {
            // remove statement
            let r = RandInt(this.shaderStatements.length);
            let s = this.shaderStatements[r];
            this.shaderStatements.splice(r, 1);
        }
        
        if (Rand() < .5)
        {
            // change order or a statement
            let r = RandInt(this.shaderStatements.length);
            let s = this.shaderStatements[r];
            this.shaderStatements.splice(r, 1);
            r = RandInt(this.shaderStatements.length+1);
            this.shaderStatements.splice(r, 0, s);
        }
        
        for(let i=RandInt(2); i--;)
        {
            // mutate statements
            let r = RandInt(this.shaderStatements.length);
            this.shaderStatements[r].Mutate();
        }
        
        if (Rand() < .2)
        {
            // insert random statement
            let statement = new ShaderStatement();
            statement.Randomize();
            let r = RandInt(this.shaderStatements.length+1);
            this.shaderStatements.splice(r, 0, statement);
        }
        
        // mutate colors
        this.hueOffset += RandBetween(-.1,.1)
        if (Rand() < .2)
            this.hueOffset = Rand();
        if (Rand() < .2)
            this.saturationScale = Rand();
        if (Rand() < .2)
            this.hueScale = RandBetween(-1,1);
        if (Rand() < .2)
        {
            for(let color of this.paletteColors)
                color.Randomize(0,1);
        }
        
        // mutate position
        if (Rand() < .1)
        {
            this.uvOffsetX = RandBetween(-1,1);
            this.uvOffsetY = RandBetween(-1,1);
            this.uvScaleX = RandBetween(-1,1);
            this.uvScaleY = RandBetween(-1,1);
        }
        else
        {
            this.uvOffsetX += RandBetween(-.1,.1);
            this.uvOffsetY += RandBetween(-.1,.1);
            this.uvScaleX += RandBetween(-.1,.1);
            this.uvScaleY += RandBetween(-.1,.1);
        }
        
        if (Rand() < .1)
            this.rotate = !this.rotate;
            
        if (Rand() < .1)
            this.iterationCount += RandInt(3)-1;
        this.iterationCount = Clamp(this.iterationCount, 1, maxIterations);
    }
    
    GetCode() 
    {
        let s = 10;
        let uvsx = (s*this.uvScaleX).toFixed(3);
        let uvsy = (s*this.uvScaleY).toFixed(3);
        let uvox = (s*this.uvOffsetX).toFixed(3);
        let uvoy = (s*this.uvOffsetY).toFixed(3);
        
        let code = ``;
        code += `// ZzArt - ${this.GetGenerationString()}\n\n`;
        if (this.usePalette)
            code += `vec3 CosinePalette( float t, vec3 a, vec3 b, vec3 c, vec3 d ) { return a + b*cos( 6.28318*(c*t+d)); }\n`;
        else
            code += `vec3 SmoothHSV(vec3 c) { vec3 rgb = clamp(abs(mod(c.x*6.+vec3(0,4,2),6.)-3.)-1.,0.,1.); return c.z * mix( vec3(1), rgb*rgb*(3.-2.*rgb), c.y); }\n`
        code += `vec4 lengthA(vec4 a)      { return vec4(length(a)); }\n`;
        code += `vec4 asinA(vec4 a)        { return asin(clamp(a,-1.,1.)); }\n`;
        code += `vec4 acosA(vec4 a)        { return acos(clamp(a,-1.,1.)); }\n`;
        code += `vec4 logA(vec4 a)         { return log(abs(a)); }\n`;
        code += `vec4 log2A(vec4 a)        { return log2(abs(a)); }\n`;
        code += `vec4 sqrtA(vec4 a)        { return sqrt(abs(a)); }\n`;
        code += `vec4 inversesqrtA(vec4 a) { return inversesqrt(abs(a)); }\n`;
        code += `vec4 pow2(vec4 a)         { return a*a; }\n`;
        code += `vec4 pow3(vec4 a)         { return a*a*a; }\n\n`;
        code += `void mainImage(out vec4 a, in vec2 p)\n{\n`;
        let rotateSwizzle = rotateCanvas^this.rotate? 'yxyx' : 'xyxy';
        code += `a=p.${rotateSwizzle}/iResolution.${rotateSwizzle};\n`;
        code += `a.xy *= vec2(${uvsx}, ${uvsy});\n`;
        code += `a.xy += vec2(${uvox}, ${uvoy});\n`;
        code += `a.wz *= vec2(${uvsx}, ${uvsy});\n`;
        code += `a.wz += vec2(${uvox}, ${uvoy});\n`;
        code += `vec4 b = a;\n\n`;
        code += `// Generated Code - Line Count: ${this.shaderStatements.length}\n`
        
        if (this.shaderStatements.length == 0)
            code += `b=a=vec4(0.0);\n`;
        else
        {
            if (this.iterationCount > 1)
                code += `for (int i = 0; i < ${this.iterationCount}; ++i)\n{\n`
            for(let statement of this.shaderStatements)
                code += statement.GetString() + '\n';
            if (this.iterationCount > 1)
                code += `}\n`
        }
        // use hsl color
        if (this.usePalette)
        {
            code += `\n// Cosine palettes by iq\n`
            code += `a.x = a.x * ${this.hueScale.toFixed(3)}+${this.hueOffset.toFixed(3)};\n`
            code += `a.xyz = b.x * CosinePalette(a.x`
            for(let color of this.paletteColors)
                code += `,\n ${color.GetShaderCode()}`;
            code += `);\n`;
        }
        else
        {
            code += `\n// Smooth HSV by iq\n`
            code += `a.x *= ${this.hueScale.toFixed(3)}+${this.hueOffset.toFixed(3)};\n`;
            code += `a.y *= ${this.saturationScale.toFixed(3)};\n`;
            code += `a.yz = clamp(a.yz,0.,1.0);\n`;
            code += `a.xyz = SmoothHSV(a.xyz);\n`;
        }
        code += `}`;
        return code;
    }
    
    Render() 
    {
        let code = this.GetCode();
        RenderShader(code);
    }
    
    GetGenerationString(shorten)
    {
        let string = ''
        
        let seed = this.randSeedString?this.randSeedString:this.randSeed;
        if (shorten)
            string += `${seed}-`;
        else
            string += this.IsVariation()? 'Generation: ' : 'Seed: '
            
        if (!this.IsVariation())
            return string + seed;
        
        if (this.subGeneration <= 1)
            string += this.generation;
        else
            string += this.generation + '-' + (this.subGeneration>27?this.subGeneration:String.fromCharCode(65+this.subGeneration-2));
            
        if (!shorten && this.IsVariation())
            string += ` (${seed})`
            
        return string;
    }
};

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// SHADER STUFF

class ShaderStatement
{
    constructor()
    {
        this.output = 'a';
        this.outputSwizzle = 'xyzw';
        this.assignmentOperator = '=';
        this.functionName = '';
        this.parameter = 'a';
        this.valueX = 1;
        this.valueY = 1;
        this.valueZ = 1;
        this.valueW = 1;
        this.parameterSwizzle = 'xyzw';
    }
    
    Randomize()
    {
        this.output = shaderRandomizer.Output();
        this.assignmentOperator = shaderRandomizer.AssignmentOperator();
        this.functionName = shaderRandomizer.FunctionName();
        this.parameter = shaderRandomizer.Parameter();
        this.valueX = shaderRandomizer.Value();
        this.valueY = shaderRandomizer.Value();
        this.valueZ = shaderRandomizer.Value();
        this.valueW = shaderRandomizer.Value();
        this.outputSwizzle = shaderRandomizer.Swizzle(1);
        this.parameterSwizzle = shaderRandomizer.Swizzle();
    }
    
    Mutate()
    {
        let r = RandInt(10);
        switch (r)
        {
            case 0: this.output = shaderRandomizer.Output(); break;
            case 1: this.assignmentOperator = shaderRandomizer.AssignmentOperator(); break;
            case 2: this.functionName = shaderRandomizer.FunctionName(); break;
            case 3: this.outputSwizzle = shaderRandomizer.Swizzle(1); break;
            case 4: this.parameter = shaderRandomizer.Parameter(); break;
            case 5: this.parameterSwizzle = shaderRandomizer.Swizzle(); break;
            case 6: this.valueX = shaderRandomizer.Value(); break;
            case 7: this.valueY = shaderRandomizer.Value(); break;
            case 8: this.valueZ = shaderRandomizer.Value(); break;
            case 9: this.valueW = shaderRandomizer.Value(); break;
        }
        
        this.valueX += 0.05*RandBetween(-1,1);
        this.valueY += 0.05*RandBetween(-1,1);
        this.valueZ += 0.05*RandBetween(-1,1);
        this.valueW += 0.05*RandBetween(-1,1);
    }
    
    GetString()
    {
        let parameter = '' + this.parameter;
        if (parameter == '')
            parameter = `vec4(${this.valueX.toFixed(3)}, ${this.valueY.toFixed(3)}, ${this.valueZ.toFixed(3)}, ${this.valueW.toFixed(3)})`;
         
        let code;
        code = this.output + '.' + this.outputSwizzle;
        code += ' ' + this.assignmentOperator + ' ' + this.functionName
        code += '(' + parameter + ')'
        code += '.' + this.parameterSwizzle;
        code += ';';
        return code;
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// SHADER RANDOMIZER

let shaderRandomizer =
{
    AssignmentOperator: function()
    {
        let f = ['=','+=','-=','*=','/='];
        return f[RandInt(f.length)];
    },
    FunctionName: function()
    {
        if (Rand() < .5)
            return '';

        let f =
        [
            'sin','cos','normalize','lengthA',
            'tan','asinA','acosA','atan',
            'logA','log2A','exp','exp2',
            'sqrtA','inversesqrtA','fract',
            'abs','sign','floor','ceil',
            'pow2','pow3'
        ];
        return f[RandInt(f.length)];
    },
    Output: function()
    {
        let f = ['a','b'];
        return f[RandInt(f.length)];
    },
    Value: function()
    {
        let v = RandBetween(0,1);
        v = v * v;
        v *= 10;
        return RandInt(2)? v : -v;
    },
    Parameter: function()
    {
        let f = ['a','b','']
        return f[RandInt(f.length)];
    },
    Swizzle: function(noDuplicates)
    {
        if (noDuplicates)
        {
            let s = ['x','y','z','w'];
            s = ShuffleArray(s);
            return s.join('');
        }

        let s = ['x','y','z','w'];
        return s[RandInt(s.length)] + s[RandInt(s.length)] + s[RandInt(s.length)] + s[RandInt(s.length)];
    }
};

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// USER INTERFACE

function UpdateUI()
{
    if (satelliteMode)
        return;

    maxIterations = Clamp(input_maxIterations.value, 1, 9);
    startIterations = Clamp(input_startIterations.value, 1, maxIterations);
    button_back.disabled = shaderMemoryLocation <= 0;
    button_forward.disabled = shaderMemoryLocation >= shaderMemory.length-1;
    button_preview.disabled = !favoriteShader || favoriteShader.gridPosX<0;
    canvas_main.hidden = showPreview;
    canvas_shader.hidden = !showPreview;
    div_advanced.style.display = advancedMode? "inline" : "none";
    textarea_debug.hidden = textarea_debug.value == '';
    
    let s = shaderMemory[shaderMemoryLocation];
    span_generations.innerHTML = s.GetGenerationString();
    
    let isMobile = IsMobile();
    if (isMobile || itchMode)
    {
        if (!itchMode)
            button_help.style.display = 'none';
        button_advanced.style.display = 'none';
        button_share.style.display = 'none';
        div_credit.style.display = 'none';
        button_openSatellite.style.display = 'none';
    }
    
    // resize canvas to fit window
    let a = canvas_main.width / canvas_main.height;
    let w = window.innerWidth - (isMobile||itchMode?20:100);
    let h = window.innerHeight - (itchMode?120:150);
    let wa = w/h;
    if (rotateCanvas)
        wa = 1/wa;
    if (wa > a)
        w = h * a;
    else
        h = w / a;
     
    canvas_main.style.width=w+'px';
    canvas_main.style.height=h+'px';
    canvas_shader.style.width=w+'px';
    canvas_shader.style.height=h+'px';

    SaveLocalStorage();
    
    if (!itchMode)
        UpdateURL();
}

function UpdateURL()
{		
    let url = GetShareUrl();
    if (url.slice(0,4) == 'http')
    {
        let shader = shaderMemory[shaderMemoryLocation];
        window.history.replaceState(null,null,url);
        document.title = `ZzArt - ` + shader.GetGenerationString();
    }
	
	document.getElementById("share_parameters").value = GetShaderData();
}

function ChangeMemoryLocation(direction)
{
    if (shaderMemoryLocation + direction < 0 || shaderMemoryLocation + direction >= shaderMemory.length)
        return;
        
    if (showPreview)
    {
        showPreview = 0;
        UpdateUI();
        return;
    }
        
    shaderMemoryLocation+=direction;
    SetFavoriteFromMemory();
    DrawShaders();
    UpdateUI();
}

function ButtonSatellite()
{
    let url = new URL(window.location.href);
    url.search = 'satellite=1';
    window.open(url);
}

function ButtonSatelliteHelp()
{
    window.alert(
`Welcome to 𝓩𝔃𝓐𝓻𝓽 ~ Abstract Art Evolution

This satellite 📡 mode allows you to view a full screen preview of our current favorite on a second monitor while browsing!`
    );
}

function ButtonHelp()
{
    window.alert(
`Welcome to 𝓩𝔃𝓐𝓻𝓽 ~ Abstract Art Evolution

To get started, click 🎲 a few times generate random seeds.
When you like something, just click it see more variations.
You can click 🔍 or press space to see a large preview.
Use 📡 to view open the large preview in a separate window.
Click 💾 to save your art as a 4K png image file.`
    );
}

function Randomize(seed)
{
    randSeed = seed;
        
    showPreview = 0;
    ++shaderMemoryLocation;
    shaderMemory.length=shaderMemoryLocation;
    shaderMemory.push(new ShaderObject());
    RandomizeShaders();
    DrawShaders();
    UpdateUI();
}

function ButtonRandomize()
{
    let seed = Math.abs(Date.now() % 1e9);
    Randomize(seed);
}

function ButtonSeed()
{
    let seedString = window.prompt('Enter a ZzArt seed to use for randomization:', '');
    if (seedString === null)
        return;
        
    seedString = String(seedString);
    let seed = parseInt(seedString);
    if (!Number.isInteger(seed))
        seed = HashString(seedString);
    if (seed==0)
        seed = 1; // prevent it from being black
    
    randSeedString = seedString;
    Randomize(seed);
    randSeedString = '';
}

function ButtonAdvanced()
{
    advancedMode = !advancedMode;
    UpdateUI();
}

function ButtonTogglePreview()
{
    showPreview = !showPreview;
    if (showPreview)
    {
        // redraw the favorite shader
        canvas_shader.width = canvas_main.width;
        canvas_shader.height = canvas_main.height;
        if (favoriteShader && favoriteShader.IsVariation())
            favoriteShader.Render();
    }
        
    UpdateUI();
}

function ButtonSave()
{
    if (!favoriteShader)
        return;

    // save large
    let scale = input_saveScale.value;
    if (scale <= 0)
        scale = 1;
    canvas_shader.width = scale*canvas_main.width;
    canvas_shader.height = scale*canvas_main.height;
    favoriteShader.Render();

    canvas_save.width = canvas_shader.width;
    canvas_save.height = canvas_shader.height;

    let x = canvasContext_save;
    x.drawImage(canvas_shader, 0, 0);
    
    if (!checkbox_hideWatermark.checked)
    {
        // watermark
        let watermarkText = `𝓩𝔃𝓐𝓻𝓽 ~ ${favoriteShader.GetGenerationString()} ~ zzart.3d2k.com`;
        let X = canvas_save.width-10;
        let Y = canvas_save.height-10;
        x.textAlign='right';
        x.shadowBlur = 6;
        x.shadowColor = '#0009';
        x.fillStyle = '#000';
        x.font = '30px monospace';
        for (let i=-1;i<=1;i+=2)
        for (let j=-1;j<=1;j+=2)
            x.fillText(watermarkText, X+1*i,Y+1*j);
        x.fillStyle='#fff';
        x.fillText(watermarkText, X,Y);
    }
    
    let filename = 'ZzArt-' + favoriteShader.GetGenerationString(1) + ".png";
    download(canvas_save.toDataURL("image/png"), filename,"image/png");
}

function SaveCode()
{
    let filename = 'ZzArt-' + favoriteShader.GetGenerationString(1) + ".txt";
    download(favoriteShader.GetCode(), filename, "data:application/octet-stream");
}

function GetShareUrl()
{
    let shader = shaderMemory[shaderMemoryLocation];
    let search = "";
    let jsonShader = JSON.stringify(shader);
    search += "&shader=" + encodeURIComponent(jsonShader);
    let url = new URL(window.location.href);
    url.search = search;
    return url.toString();
}

function GetShaderData()
{
    let shader = shaderMemory[shaderMemoryLocation];
    let jsonShader = JSON.stringify(shader);
	return jsonShader;
}

function OpenCapJS()
{
    if (!favoriteShader)
        return;

    let filename = 'ZzArt - ' + favoriteShader.GetGenerationString();
    let search = "";
    search += "filename=" + encodeURIComponent(filename);
    search += "&mode=" + encodeURIComponent('shadertoy');
    search += "&code=" + encodeURIComponent(favoriteShader.GetCode());
    let url = new URL('https://capjs.3d2k.com');
    url.search = search;
    window.open(url);
}

onresize=_=>UpdateUI();

let onselect=e=>
{
    if (e.button != 0 || satelliteMode)
        return;
        
    let rect = canvas_main.getBoundingClientRect();
    let scaleX = canvas_main.width / rect.width;
    let scaleY = canvas_main.height / rect.height;
    let mouseX = (e.clientX- rect.left) * scaleX; 
    let mouseY = (e.clientY- rect.top) * scaleY;
    let X = gridSize * mouseX / canvas_main.width | 0;
    let Y = gridSize * mouseY / canvas_main.height | 0;
    
    if (X<0 || X>gridSize-1 || Y<0 || Y>gridSize-1)
        return; 
       
    SetBest(X,Y);
}

canvas_main.onmousedown=onselect;
canvas_main.ontouch=onselect;

canvas_shader.onclick=e=>
{
    if (satelliteMode)
        return;

    showPreview = 0;
    UpdateUI();
}

onkeydown=e=>
{
    if (satelliteMode)
        return;
        
    let used = 0;
    if (e.keyCode == 32) // Space
    {
        if (favoriteShader)
            ButtonTogglePreview();
        used = 1;
    }
    else if (e.keyCode == 83) // S
        ButtonSave(), used = 1;
    else if (e.keyCode == 90) // Z
        ChangeMemoryLocation(-1), used = 1;
    else if (e.keyCode == 88) // X
        ChangeMemoryLocation(1), used = 1;
    else if (e.keyCode == 82) // R
        ButtonRandomize(), used = 1;
    
    if (used)
    {
        e.preventDefault();
        e.stopPropagation();
    }
}

///////////////////////////////////////////////////////////////////////////////
// SAVE & LOAD

function LoadFromURL()
{
    let url = new URL(window.location.href);
    let searchParams = url.searchParams;
    if (searchParams.has('shader'))
    {
        let shaderText = searchParams.get('shader');
        let rawObject = JSON.parse(shaderText);
        favoriteShader = Object.assign(new ShaderObject(), rawObject).Clone();
    }
    
    if (IsMobile() && window.history)
    {
        url.search= "";
        window.history.pushState(null,null,url.toString())
    }
    
    if (!IsMobile() && !itchMode && searchParams.has('satellite'))
        satelliteMode = parseInt(searchParams.get('satellite'));
}

function SaveLocalStorage()
{
    if (satelliteMode)
        return;

    localStorage.version = dataVersion;
    let shader = shaderMemory[shaderMemoryLocation];
    localStorage.setItem('favorite', JSON.stringify(shader));
    localStorage.setItem('hideWatermark', checkbox_hideWatermark.checked?1:0);
    //localStorage.setItem('advancedMode', advancedMode?1:0);
    localStorage.setItem('saveScale', input_saveScale.value);
}

function LoadLocalStorage()
{
    if (localStorage.version != dataVersion)
        return;

    let localStorageItem;
    localStorageItem = localStorage.getItem('hideWatermark');
    if (localStorageItem)
        checkbox_hideWatermark.checked = parseInt(localStorageItem);
    
    //localStorageItem = localStorage.getItem('advancedMode');
    //if (localStorageItem)
    //    advancedMode = parseInt(localStorageItem);
    
    localStorageItem = localStorage.getItem('saveScale');
    if (localStorageItem)
        input_saveScale.value = parseFloat(localStorageItem);
         
    localStorageItem = localStorage.getItem('favorite');
    if (localStorageItem && !favoriteShader)
    {
        let rawObject = JSON.parse(localStorageItem);
        favoriteShader = Object.assign(new ShaderObject(), rawObject).Clone();
    }
}

///////////////////////////////////////////////////////////////////////////////
// SERVER DATA

const feedLimit = <?php $feedLimit = 10; echo $feedLimit; ?>;
let feed;
try {
	feed = <?php 
$files = scandir('data', SCANDIR_SORT_DESCENDING);
$feed = [];
$files = array_diff(scandir('data'), array('last', '..', '.')); // filter other files
if (count($files) >= $feedLimit) {
    // so it will not break
    $files = array_splice($files, count($files)-$feedLimit, $feedLimit);
} else {
    $files = array_splice($files, 0, count($files));
}
foreach ($files as $fileName) {
    // for extra parsing
    if (is_numeric($fileName)) {
        array_push($feed, $fileName);
    }
}

$feedItems = []; // array with the shader parameters
foreach ($feed as $feedItem) {
    $fileData = file_get_contents("./data/$feedItem");
    $update = substr($fileData, 0, -1); // open the object
    $update .= ", id: $feedItem}"; // add the file id to the object
    array_push($feedItems, $update);
}

echo "[".implode(", ", $feedItems)."]";	
?>;
} catch (e) {
	alert("There was an error when loading the feed data.");
	feed = [];
}

///////////////////////////////////////////////////////////////////////  
// WEBGL STUFF

let vertexShader = 0;
function InitWebgl() 
{
    let x = canvasContext_shader;

    // create simple pass through vertex shader
    vertexShader=x.createShader(x.VERTEX_SHADER);
    x.shaderSource(vertexShader,"attribute vec4 p;void main(){gl_Position=p;}")
    x.compileShader(vertexShader);
    let compiled = x.getShaderParameter(vertexShader, x.COMPILE_STATUS);
    if (!compiled)
    {
        let shaderLog = x.getShaderInfoLog(vertexShader);
        textarea_debug.value = compiled? "" : "VERTEX SHADER ERROR!\n" + shaderLog;
        vertexShader = 0;
        return;
    }
    
    // create vertex buffer that is a giant triangle to cover the viewport
    let vertexBuffer=x.ARRAY_BUFFER;
    x.bindBuffer(vertexBuffer,x.createBuffer());
    x.bufferData(vertexBuffer,new Int8Array([-3,1,1,-3,1,1]),x.STATIC_DRAW);
    x.enableVertexAttribArray(0);
    x.vertexAttribPointer(0,2,x.BYTE,0,0,0); // 2D vertex
}

function RenderShader(code) 
{
    if (!vertexShader)
        return;
    
    // create pixel shader
    let x = canvasContext_shader;
    let shaderProgram = x.createProgram();
    let pixelShader = x.createShader(x.FRAGMENT_SHADER)
    let shaderProgramCode = 
        "precision mediump float;"+
        `const vec3 iResolution = vec3(${canvas_shader.width},${canvas_shader.height},0.);`+
        code+
        `\nvoid main(){mainImage(gl_FragColor,gl_FragCoord.xy);gl_FragColor.a=1.;}`
    x.shaderSource(pixelShader, shaderProgramCode)
    x.compileShader(pixelShader);
    
    // check for errors
    let debugOutput="";
    let compiled = x.getShaderParameter(pixelShader, x.COMPILE_STATUS);
    let shaderLog = x.getShaderInfoLog(pixelShader);
    textarea_debug.value = compiled? "" : "FRAGMENT SHADER ERROR!\n" + shaderLog;
    if (!compiled)
    {
        shaderProgram = 0;
        return;
    }

    // link program
    x.attachShader(shaderProgram,vertexShader);
    x.attachShader(shaderProgram, pixelShader);
    x.linkProgram(shaderProgram);
    let linkGood = x.getProgramParameter(shaderProgram, x.LINK_STATUS);
    if (!linkGood)
    {
        // something went wrong with the link
        textarea_debug.value = "LINK ERROR!\n" + x.getProgramInfoLog(shaderProgram);
        return;
    }
    
    // render
    x.viewport(0, 0, canvas_shader.width, canvas_shader.height);
    x.useProgram(shaderProgram);
    x.drawArrays(x.TRIANGLE_FAN, 0, 3);
}

///////////////////////////////////////////////////////////////////////////////
// MATH STUFF

let randSeedString = '';
let randSeed = Date.now();
function RandSeeded()
{
    randSeed^=randSeed<<13
    randSeed^=randSeed>>7
    randSeed^=randSeed<<17
    return Math.abs(randSeed);
}

let Rand             = (m=1)=>m*RandInt(1e9)/1e9;
let RandInt          = m=>RandSeeded()%m;
let RandBetween      = (a,b)=>a+Rand(b-a);
let RandIntBetween   = (a,b)=>a+RandInt(b-a+1);

let HashString=string=>
{
    let hash=0;
    for (let i=0; i<string.length; i++)
        hash = (hash << 5) - hash + string.charCodeAt(i) | 0;
    return hash;
};

let PI                  = Math.PI;
let Min=(a, b)          => a<b? a : b;
let Max=(a, b)          => a>b? a : b;
let Clamp=(v, min, max) => Min(Max(v, min), max);
let Percent=(v, a, b)   => a==b? 0 : Clamp((v-a)/(b-a), 0, 1);
let Lerp=(p, a, b)      => a + Clamp(p, 0, 1) * (b-a);

function ShuffleArray(array) 
{
    let currentIndex = array.length;
    while (currentIndex) 
    {
        let randomIndex = RandInt(currentIndex);
        --currentIndex;
        let temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}
    
class Vector3 
{
    constructor(x=0, y=0, z=0) { this.x = x; this.y = y; this.z = z; }
    Randomize(min, max)
    { 
        this.x = RandBetween(min,max); 
        this.y = RandBetween(min,max); 
        this.z = RandBetween(min,max); 
    }
    
    GetShaderCode() { return `vec3(${this.x.toFixed(3)}, ${this.y.toFixed(3)}, ${this.z.toFixed(3)})`; }
}

///////////////////////////////////////////////////////////////////////  

let IsMobile=_=>!itchMode&&((navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i))!= null);

///////////////////////////////////////////////////////////////////////  

//download.js v4.21, by dandavis; 2008-2018. [MIT] see http://danml.com/download.html for tests/usage
;(function(root,factory){typeof define=="function"&&define.amd?define([],factory):typeof exports=="object"?module.exports=factory():root.download=factory()})(this,function(){return function download(data,strFileName,strMimeType){let self=window,defaultMime="application/octet-stream",mimeType=strMimeType||defaultMime,payload=data,url=!strFileName&&!strMimeType&&payload,anchor=document.createElement("a"),toString=function(a){return String(a)},myBlob=self.Blob||self.MozBlob||self.WebKitBlob||toString,fileName=strFileName||"download",blob,reader;myBlob=myBlob.call?myBlob.bind(self):Blob,String(this)==="true"&&(payload=[payload,mimeType],mimeType=payload[0],payload=payload[1]);if(url&&url.length<2048){fileName=url.split("/").pop().split("?")[0],anchor.href=url;if(anchor.href.indexOf(url)!==-1){let ajax=new XMLHttpRequest;return ajax.open("GET",url,!0),ajax.responseType="blob",ajax.onload=function(e){download(e.target.response,fileName,defaultMime)},setTimeout(function(){ajax.send()},0),ajax}}if(/^data:([\w+-]+\/[\w+.-]+)?[,;]/.test(payload)){if(!(payload.length>2096103.424&&myBlob!==toString))return navigator.msSaveBlob?navigator.msSaveBlob(dataUrlToBlob(payload),fileName):saver(payload);payload=dataUrlToBlob(payload),mimeType=payload.type||defaultMime}else if(/([\x80-\xff])/.test(payload)){let i=0,tempUiArr=new Uint8Array(payload.length),mx=tempUiArr.length;for(i;i<mx;++i)tempUiArr[i]=payload.charCodeAt(i);payload=new myBlob([tempUiArr],{type:mimeType})}blob=payload instanceof myBlob?payload:new myBlob([payload],{type:mimeType});function dataUrlToBlob(strUrl){let parts=strUrl.split(/[:;,]/),type=parts[1],indexDecoder=strUrl.indexOf("charset")>0?3:2,decoder=parts[indexDecoder]=="base64"?atob:decodeURIComponent,binData=decoder(parts.pop()),mx=binData.length,i=0,uiArr=new Uint8Array(mx);for(i;i<mx;++i)uiArr[i]=binData.charCodeAt(i);return new myBlob([uiArr],{type:type})}function saver(url,winMode){if("download"in anchor)return anchor.href=url,anchor.setAttribute("download",fileName),anchor.className="download-js-link",anchor.innerHTML="downloading...",anchor.style.display="none",anchor.addEventListener("click",function(e){e.stopPropagation()}),document.body.appendChild(anchor),setTimeout(function(){anchor.click(),document.body.removeChild(anchor),winMode===!0&&setTimeout(function(){self.URL.revokeObjectURL(anchor.href)},250)},66),!0;if(/(Version)\/(\d+)\.(\d+)(?:\.(\d+))?.*Safari\//.test(navigator.userAgent))return/^data:/.test(url)&&(url="data:"+url.replace(/^data:([\w\/\-\+]+)/,defaultMime)),window.open(url)||confirm("Displaying New Document\n\nUse Save As... to download, then click back to return to this page.")&&(location.href=url),!0;let f=document.createElement("iframe");document.body.appendChild(f),!winMode&&/^data:/.test(url)&&(url="data:"+url.replace(/^data:([\w\/\-\+]+)/,defaultMime)),f.src=url,setTimeout(function(){document.body.removeChild(f)},333)}if(navigator.msSaveBlob)return navigator.msSaveBlob(blob,fileName);if(self.URL)saver(self.URL.createObjectURL(blob),!0);else{if(typeof blob=="string"||blob.constructor===toString)try{return saver("data:"+mimeType+";base64,"+self.btoa(blob))}catch(y){return saver("data:"+mimeType+","+encodeURIComponent(blob))}reader=new FileReader,reader.onload=function(e){saver(this.result)},reader.readAsDataURL(blob)}return!0}});

///////////////////////////////////////////////////////////////////////  

Init();

</script>
</body>
</html>
