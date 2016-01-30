import $ from 'jquery'
import Routing from 'routing'

export default {   
	getJSON(route,data){ 
		//Generate Symfony URL
    	let url = Routing.generate(route,data);
      return $.getJSON(url).pipe((response) => {
        	return response.success ? response.data : 'Error';
        	console.log(response);
      });
	},
	post(route,params,data){
		return $.post(Routing.generate(route,params),{data:data})
		.pipe((response) => {
			response = JSON.parse(response);
			return response.success ? response.data : 'Error';
        });
	},
  	getPosts(target){     
  		return this.getJSON('comments',{target:target});   
  	},
  	createPost(data){
  		return this.post('post_comment',{},data);
  	},
    assessComment(data){
      return this.post('comment_assess',{target:data.comment},data);
    } 
}; 
