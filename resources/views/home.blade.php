@extends('layouts.nav')

@section('content')
<style>
 #scroll {
  
  height:300px;
  
  overflow:auto;
}
</style>

<!-- INICIO POSTAGENS-->
<div class="col-xs-8">
    <div id="myCarousel" class="carousel slide" data-interval="5000" data-ride="carousel">
      <!-- Indicators -->
        <ol class="carousel-indicators">
         <?php $ind = true ?>
            @for($i=0; $i<=count($postPrinc); $i++)
                
                <li data-target="#myCarousel" data-slide-to="{{ $i }}" class="{{ $ind ? ' active' : '' }}"></li>
                <?php $ind = false ?>
            @endfor

        </ol>
          <?php $isFirst = true ?>
           <div class="carousel-inner">
                @foreach($postPrinc as $post)                           
                <div class="item {{ $isFirst ? ' active' : '' }}">
                      <a href="{{ $post->referencia }}"><img src="/uploads/postprincipal/{{ $post->img}}" alt=""></a>
                    <div class="carousel-caption">
                        <h2>{{ $post->titulo}}</h2>
                        <p>{{ $post->descricao}}</p>
                    </div>
                </div>                       
                  <?php $isFirst = false ?>
                @endforeach
            </div>
             
      <!-- Wrapper for slides -->
       

      <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
    </div>
        <div>                
            <h3>Noticias recentes</h3>
            <hr>
        </div>
        
        @forelse($posts as $post)
            <div>
                <div class="col-md-12 postagem"> 
                   
                        
                            <img  style="padding-right: 25px;" align="left" class="img-responsive" src="/uploads/post/{{ $post->img_destacada}}" alt="">
                   
                        <h4>
                            <a style="color: #333;" href="{{ route('home.postagem', $post->id) }}">{{ $post->titulo}}</a>
                        </h4>
                        <p><span class="glyphicon glyphicon-time"></span> Postado em {{ $post->created_at }}</p>                                    
                        <p>{!! str_limit(strip_tags($post->corpo,350)) !!}</p>                                          
                  
                    <div class="row">
                        <a class="btn btn-default pull-right" href="{{ route('home.postagem', $post->id) }}">Leia mais...<span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                
                </div>
            </div>                           
        @empty
        <p>Nenhum post cadastrado</p>

        @endforelse
        
        <div align="center">
            {!! $posts->links() !!}
        </div> 
</div>
<!-- FIM POSTAGENS--> 
<!-- INICIO SIDEBAR-->               
<div class="col-xs-4">                   
    <div class="panel-group">
        <!-- INICIO ANIVERSARIANTES -->
        <div class="panel panel-gt" >
            <div class="panel-heading">
                <h4 class="text-center"><i class="fa fa-birthday-cake" aria-hidden="true"></i> Aniversariantes do mês</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12" id="scroll">                                    
                     @foreach($aniversarioMes as $userMes)
                        <div class="row">
                            <div class="profile-header-container">                                   
                                <div class="profile-header-img col-md-4 nopadding-right">          
                                    <img src="/uploads/perfil/{{ $userMes->avatar }}" class="img-circle">
                                    <div class="rank-label-container">
                                        <span class="label label-default rank-label">{{ $userMes->nascimento }}</span>
                                    </div>
                                </div>                                   
                                <div class="profile-header-name col-md-8 nopadding-right nopadding-left">
                                    {{ $userMes->name }} {{ $userMes->sobrenome}}<br>
                                    <small>{{ $userMes->setor }}</small>
                                </div>
                            </div>
                        </div> 
                    @endforeach                                         
                </div>                              
            </div>
        </div>
        <!-- FIM ANIVERSARIANTES -->
        <!-- INICIO ENQUETES -->
        @foreach($enquetes as $enquete)
            <div class="panel panel-gt">
                <div class="panel-heading">
                    <h4 class="text-center"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ $enquete->pergunta }}</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-8 col-md-offset-2">
                        <ul>                                                                                  
                            <div class="row">
                                <form action="{{ route('enquete.salvar', $enquete->id) }}" method="post"> 
                                    {{ csrf_field() }}
                                    <div class="form-check">                                                        
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="resposta" value="{{$enquete->opcao1}}" checked> {{$enquete->opcao1}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                         <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="resposta" value="{{$enquete->opcao2}}"> {{$enquete->opcao2}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                         <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="resposta" value="{{$enquete->opcao3}}"> {{$enquete->opcao3}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                         <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="resposta" value="{{$enquete->opcao4}}"> {{$enquete->opcao4}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                         <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="resposta" value="{{$enquete->opcao5}}"> {{$enquete->opcao5}}
                                        </label>
                                    </div>
                                </form>
                            </div>                                           
                        </ul>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <input type="submit" value="Votar" class="btn btn-danger btn-block">
                        </div>
                    </div>
                </div>                                
            </div>
        @endforeach
        <!-- FIM ENQUETES -->
        <!-- INICIO FORMULARIOS -->
        @foreach($sugestoes as $sugestao)
            <div class="panel panel-gt">
                <div class="panel-heading">
                    <h4 class="text-center"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ $sugestao->titulo }}</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">                            
                         <form action="{{ route('formulario.salvar', $sugestao->id) }}" method="post"> 
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('sugestao') ? ' has-error' : '' }}">
                                <p>{{ $sugestao->corpo }}</p>
                                <textarea name="mensagem" cols="30" rows="3" class="form-control" placeholder="Sugestão"></textarea>
                                @if ($errors->has('sugestao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sugestao') }}</strong>
                                    </span>
                                @endif                                
                            </div>                            
                            <div class="form-group">
                                <div class="text-center">
                                    <input type="submit" value="Enviar" class="btn btn-danger btn-block">
                                </div>
                            </div>
                        </form>                            
                    </div>
                </div>                                
            </div>
        @endforeach
        <!-- FIM FORMULARIOS -->
    </div>
</div>
<!-- FIM SIDEBAR-->




            
            

            <!-- Blog Sidebar Widgets Column -->
           <div class="row">

                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; G TRIGUEIRO 2017</p>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </footer>
            </div>
    



    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
@endsection


  