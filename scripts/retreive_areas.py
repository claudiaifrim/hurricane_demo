import csv
from geotext import GeoText

h_file = open('hurricanes.csv')
o_file = open('computed_areas.csv', 'wb')
hurricanes = csv.reader(h_file)

# Create Writer Object
wr = csv.writer(o_file, dialect='excel')

for row in hurricanes:
  h_uri = str(row[0])
  h_abstract = str(row[1])
  #print('Row #' + str(hurricanes.line_num) + ' ' + h_uri + ' ' + h_abstract)
  
  h_regions = GeoText(h_abstract)
  
  cities = list(set(h_regions.cities))
  countries = list(set(h_regions.countries))
  
  if len(cities) != 0 :
    print('Cities: ')
    for city in cities:
      print(city)
      wr.writerow([h_uri, city])
      
  if len(countries) != 0 :
    print('Countries: ')
    for country in countries:
      print(country)
      wr.writerow([h_uri, country])
#   print('Row #' + str(hurricanes.line_num) + ' ' + str(h_regions.cities) + ' ' + str(h_regions.countries))
  
o_file.close();

