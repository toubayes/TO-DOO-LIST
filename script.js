class Slider{
    constructor(){
      this.images = [];
      this.images[0] = "img/img.jpg";
      this.images[1] = "img/img2.jpg";
      this.images[2] = "img/img3.jpg";
      this.images[3] = "img/img4.jpg";
      this.images[4] = "img/img5.jpg";
      this.images[5]="img/img6.jpg";
      this.images[6] = "img/img7.jpg";
      this.images[7] = "img/img8.jpg";
      this.images[8]="img/img9.jpeg";
  
  
    //   this.links=[];
    //   this.links[0]= "https://www.youtube.com/playlist?list=PLMTdZ61eBnyp1nMM8mGRzpwuu6FNxFy0D";
    //   this.links[1] = "#";
    //   this.links[2] = "#";
      this.counter = 0;
  
      this.playSlider();
  
      setInterval(()=>{
        this.playSlider();
      },3000);
  
    }
    playSlider(){
      if(this.counter< this.images.length - 1){
        this.counter++;
      }
      else{
        this.counter = 0;
      }
  
      document.slider_show.src = this.images[this.counter];
    //   document.getElementById("LinkImg").href= this.links[this.counter];
  
   
    }
  }
  onload = new Slider();
