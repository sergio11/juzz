import React from 'react';

class ProfileCard extends React.Component{
    
    constructor(props){
        super(props);
    }
    
    
    renderSocialInfo(){
        return (
            <div className="left_col">
                <div className="followers">
                    <div className="follow_count">18,541</div>
                    Followers
                </div>
                <div className="following">
                    <div className="follow_count">181</div>
                    Following
                </div>
            </div>
        )
    }
    
    renderUserInfo(){
        return(
            <div class="right_col">
                <h2 class="name">John Doe</h2>
                <h3 class="location">San Francisco, CA</h3>
                <ul class="contact_information">
                <li class="work">CEO</li>
                <li class="website"><a class="nostyle" href="#">www.apple.com</a></li>
                <li class="mail">john.doe@apple.com</li>
                <li class="phone">1-(732)-757-2923</li>
                <li class="resume"><a href="#" class="nostyle">download resume</a></li>
                </ul> 
            </div>
        )
    }
    
    render(){
        return (
            <div className="portfoliocard">
                <div className="coverphoto"></div>
		        <div className="profile_picture"></div>
                {this.renderSocialInfo()}   
                {this.renderUserInfo()}
             </div>
        );
    }
    
}

export default ProfileCard;