from pyramid.response import Response
from pyramid.view import view_config

from sqlalchemy.exc import DBAPIError

from .models import (
    DBSession,
    )

#@view_config(route_name='home', renderer='templates/mytemplate.pt')
def login(request):
    """ login(request)
    No return value

    Function called from route_url('apex_login', request)
    """
    title = _('You need to login')
    came_from = get_came_from(request)
    if not apex_settings('exclude_local'):
        if asbool(apex_settings('use_recaptcha_on_login')):
            if apex_settings('recaptcha_public_key') and apex_settings('recaptcha_private_key'):
                LoginForm.captcha = RecaptchaField(
                    public_key=apex_settings('recaptcha_public_key'),
                    private_key=apex_settings('recaptcha_private_key'),
                )
            form = LoginForm(request.POST,
                            captcha={'ip_address': request.environ['REMOTE_ADDR']})
        else:
            form = LoginForm(request.POST)
    else:
        form = None

    velruse_forms = generate_velruse_forms(request, came_from)

    if request.method == 'POST' and form.validate():
        user = AuthUser.get_by_login(form.data.get('login'))
        if user:
            headers = apex_remember(request, user)
            return HTTPFound(location=came_from, headers=headers)

    return {'title': title, 'form': form, 'velruse_forms': velruse_forms, \
            'form_url': request.route_url('apex_login'),
            'action': 'login'}
    




