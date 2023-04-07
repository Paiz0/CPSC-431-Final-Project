// This function gets run immediately upon the webpage loading
window.onload = function() {
    var dropdown_content = document.getElementById("titles");

    const titles = ["MD" , "DO", "DDS", "DVM", "MBBS", "BAMS", "BHMS", "BUMS", "BDS", "OD", "DPM", "PhD", "MSc", "MPH", "MS", "MCh", "DNB", "FRCS", "FACS", "FAAP", "FAAFP", "FRCPC", "FCPS", "FRCOG", "FRCSC", "MRCP", "MRCS", "MRCOG", "MRCPCH", "MRCGP", "DCH", "DM", "DS", "DSc", "DA", "DLO", "DVD", "DCP", "DMRD", "DTCD", "DGO", "DPM", "DPH", "DMRT", "DHA", "DDVL", "MDVL", "DHFWM", "DMLE", "DIB", "DIM", "DDM", "DPMR", "DPMO", "DPMRT", "DMREP", "DAA", "DFM", "DAEM", "DHAEM", "FEM", "FFARCSI", "FFARCS", "FFARCSI Anaes", "FFARCSI Pain", "FFARCSI Critical Care", "FFARCSI Oncology"];

    for(let i = 0; i < titles.length; i++)
    {
        var childState = document.createElement("div");

        // childState.style = "border: none; background-color: white;";
        // childState.style = "border: 1px solid #ccc; background-color: #f7f7f7; padding: 5px; cursor: pointer;";
        childState.innerHTML = titles[i];
        // childState.onclick = "alert('Hello!')";
        childState.onclick = (function(title) {
            return function() {
                setState(title);
            }
        })(titles[i]);

        dropdown_content.appendChild(childState);

    }
}

function setState(text)
{
    var title = document.getElementById("title");
    var curr_title = document.getElementById("curr_title");

    // var titles = document.getElementById("titles");
    // var curr_title = document.getElementById("curr_title");

    // titles.disabled = "false";
    // titles.value = text;

    title.value = text;

    curr_title.style.cssText = 'top: -5px; color: #2691d9;';
}