import pandas as pd
import plotly.express as px
import plotly.io as pio
df = pd.read_excel('http://localhost/PythonPHP/DataUdara.xlsx') # path to  dataset

fig = px.scatter(df, x= 'NMHC(GT)', y = 'RH'
                 , hover_data=['Time', 'CO(GT)', 'PT08.S1(CO)', 'NMHC(GT)', 'C6H6(GT)', 'PT08.S2(NMHC)', 'NOx(GT)', 'PT08.S3(NOx)', 'NO2(GT)', 'PT08.S4(NO2)', 'PT08.S5(O3)', 'T', 'AH']
                 )

fig.update_layout(template='plotly_white')
fig.update_layout(title='Air Quality - Unclustered Data')

try:
    pio.write_html(fig, file='assets/unclustered-plot.html', auto_open=False)
    print(True)
except:
    print(False) 
