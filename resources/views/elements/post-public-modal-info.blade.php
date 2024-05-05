<div class="modal fade" tabindex="-1" role="dialog" id="post-set-public">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Créer un post du type public')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{__('Ces posts apparaîtront sur le mur public de la plateforme.')}} </p>
                @if ((isset($post) && $post->is_public))
                    <p>{{ sprintf('Vous en avez %d  post public (max %d)',$countPostPublic ,$maxPostPublic) }}  <a  class="file-upload-button-public-post" data-dismiss="modal" href="#" > {{__("modifier le post public.")}}</a></p> 
                @else
                    <p>{{ sprintf('Vous en avez %d  post public (max %d)',$countPostPublic ,$maxPostPublic) }}  <a  class="file-upload-button-public-post" data-dismiss="modal" href="#" > {{__("+ ajouter un nouveau post public.")}}</a></p> 
                @endif
               
            </div>
            {{-- <div class="modal-footer text-right">
                <button type="button" class="btn btn-white" data-dismiss="modal" >{{__('Annuler')}}</button>
            </div> --}}
        </div>
    </div>
</div>
