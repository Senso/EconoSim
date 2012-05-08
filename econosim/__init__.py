from pyramid.config import Configurator
from sqlalchemy import engine_from_config

from .models import DBSession
from .models import initialize_sql

from views import login

def main(global_config, **settings):
    """ This function returns a Pyramid WSGI application.
    """
    engine = engine_from_config(settings, 'sqlalchemy.')
    DBSession.configure(bind=engine)
    
    initialize_sql(engine_from_config(settings, 'sqlalchemy.'), settings)
    
    config = Configurator(settings=settings)
    config.add_static_view('static', 'static', cache_max_age=3600)
    config.add_route('home', '/')
    
    config.add_route('login', '/login')
    config.add_view(login, route_name='login',
                    renderer=render_template, permission=NO_PERMISSION_REQUIRED)
    
    config.scan()
    return config.make_wsgi_app()

