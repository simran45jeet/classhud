<?php foreach ($record['user_reviews']["records"] as $key => $user_review) { ?>
    <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-84">
        <div id="comment-84" class="the-comment media-comment">
            <div class="media-comment-left">
                <div class="author-image">

    <!--<img alt='' src='data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%2048%2048%22%3E%3C/svg%3E' data-src='https://secure.gravatar.com/avatar/ff85f759d0074f76f01e041beb96c350?s=48&#038;d=mm&#038;r=g' data-srcset='https://secure.gravatar.com/avatar/ff85f759d0074f76f01e041beb96c350?s=96&#038;d=mm&#038;r=g 2x' class='lazyload avatar avatar-48 photo' height='48' width='48' />-->
                </div>
            </div>
            <div class="comment-box media-comment-body">
                <div class="author-meta"> 
                    <cite class="fn">
                        <?php echo $user_review["full_name"]; ?>
                    </cite> 
                    <span class="comment-info"> <a href="#"><?php echo date(VIEW_DATE_FORMAT, strtotime($user_review["created_at"])) ?></a> </span>
                </div>
                <div class="comment-body">
                    <div class="comment-review-result">
                        <span>
                            <ul class="comment-rating-ul">
                                <?php foreach ($user_review["category_rating"] as $key => $category_rating) { ?>
                                    <li>
                                        <span class="comment-rating-criterion"><?php echo $category_rating["name"] ?></span>
                                        <span class="comment-rating-stars stars">
                                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                <span class="star">
                                                    <i class="<?php echo $i <= $category_rating["category_rating"] ? "las" : "lar" ?> la-star">
                                                    </i>
                                                </span>
                                            <?php } ?>                                                                                                                            
                                        </span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </span>
                    </div>
                    <p><?php echo $user_review["review"] ?></p>
                </div>
                <!--                                                                                                    <div class="comment-action-wrap"> <a rel='nofollow' class='comment-reply-link' href='https://gaviaspreview.com/wp/fioxen/listing/novotel-london-canary/?replytocom=84#respond' data-commentid="84" data-postid="650" data-belowelement="comment-84" data-respondelement="respond" data-replyto="Reply to admin" aria-label='Reply to admin'>
                                                                                                                            <i class="far fa-comment-dots">
                                                                                                                            </i>Reply</a>
                                                                                                                    </div>-->
            </div>
        </div>
    </li>
<?php } ?>