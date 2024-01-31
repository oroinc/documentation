FROM sphinxdoc/sphinx:7.1.2

RUN apt-get -y update
RUN apt-get -y install git

WORKDIR /documentation
ADD requirements.txt /documentation
RUN pip3 install -r requirements.txt